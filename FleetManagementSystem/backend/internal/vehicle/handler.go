package vehicle

import (
	"FMSBackend/internal/auth"
	"FMSBackend/internal/database"
	"database/sql"
	"encoding/json"
	"fmt"
	"io"
	"mime/multipart"
	"net/http"
	"os"
	"path/filepath"
	"strconv"
	"time"

	"github.com/gorilla/mux"
)

type Handler struct {
	DB *sql.DB
}

func RegisterVehicleRoutes(router *mux.Router, db *sql.DB) {
	h := &Handler{DB: db}
	router.HandleFunc("/vehicles", h.CreateVehicle).Methods("POST")
	router.HandleFunc("/vehicles", h.GetVehicles).Methods("GET")
	router.HandleFunc("/vehicles/{id}", h.GetVehicle).Methods("GET")
	router.HandleFunc("/vehicles/{id}", h.UpdateVehicle).Methods("PUT")
	router.HandleFunc("/vehicles/{id}", h.DeleteVehicle).Methods("DELETE")
}

func (h *Handler) CreateVehicle(w http.ResponseWriter, r *http.Request) {
	var vehicle auth.Vehicle
	if err := json.NewDecoder(r.Body).Decode(&vehicle); err != nil {
		http.Error(w, err.Error(), http.StatusBadRequest)
		return
	}

	file, fileHeader, err := r.FormFile("image")
	if err != nil {
		http.Error(w, err.Error(), http.StatusBadRequest)
		return
	}
	defer file.Close()

	imagePath, err := saveImage(file, fileHeader)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	vehicle.ImagePath = imagePath

	if err := database.AddVehicle(h.DB, vehicle.Make, vehicle.Model, vehicle.Year, vehicle.Status, vehicle.AssignedTo, vehicle.ImagePath); err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusCreated)
	json.NewEncoder(w).Encode(vehicle)
}

func (h *Handler) GetVehicles(w http.ResponseWriter, r *http.Request) {
	vehicles, err := database.GetAllVehicles(h.DB)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusOK)
	json.NewEncoder(w).Encode(vehicles)
}

func (h *Handler) GetVehicle(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	id, err := strconv.Atoi(vars["id"])
	if err != nil {
		http.Error(w, "Invalid vehicle ID", http.StatusBadRequest)
		return
	}

	vehicle, err := database.GetVehicleByID(h.DB, id)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusOK)
	json.NewEncoder(w).Encode(vehicle)
}

func (h *Handler) UpdateVehicle(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	id, err := strconv.Atoi(vars["id"])
	if err != nil {
		http.Error(w, "Invalid vehicle ID", http.StatusBadRequest)
		return
	}

	var vehicle auth.Vehicle
	if err := json.NewDecoder(r.Body).Decode(&vehicle); err != nil {
		http.Error(w, err.Error(), http.StatusBadRequest)
		return
	}

	file, fileHeader, err := r.FormFile("image")
	if err == nil {
		defer file.Close()
		imagePath, err := saveImage(file, fileHeader)
		if err != nil {
			http.Error(w, err.Error(), http.StatusInternalServerError)
			return
		}
		vehicle.ImagePath = imagePath
	}

	if err := database.UpdateVehicle(h.DB, id, vehicle.Make, vehicle.Model, vehicle.Year, vehicle.Status, vehicle.AssignedTo, vehicle.ImagePath); err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusOK)
	json.NewEncoder(w).Encode(vehicle)
}

func (h *Handler) DeleteVehicle(w http.ResponseWriter, r *http.Request) {
	vars := mux.Vars(r)
	id, err := strconv.Atoi(vars["id"])
	if err != nil {
		http.Error(w, "Invalid vehicle ID", http.StatusBadRequest)
		return
	}

	if err := database.DeleteVehicle(h.DB, id); err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusOK)
}

func saveImage(file multipart.File, fileHeader *multipart.FileHeader) (string, error) {
	extension := filepath.Ext(fileHeader.Filename)
	newFileName := fmt.Sprintf("%d%s", time.Now().Unix(), extension)
	imagePath := filepath.Join("uploads", newFileName)

	outFile, err := os.Create(imagePath)
	if err != nil {
		return "", err
	}
	defer outFile.Close()

	_, err = io.Copy(outFile, file)
	if err != nil {
		return "", err
	}

	return imagePath, nil
}
