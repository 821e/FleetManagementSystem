package database

import (
	"database/sql"
	"fmt"
	"log"
	"os"

	"FMSBackend/internal/auth" // Import the correct package for Vehicle

	_ "github.com/go-sql-driver/mysql"
)

var db *sql.DB

func InitDB() *sql.DB {
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s",
		os.Getenv("DB_USER"), os.Getenv("DB_PASSWORD"), os.Getenv("DB_HOST"), os.Getenv("DB_PORT"), os.Getenv("DB_NAME"))
	var err error
	db, err = sql.Open("mysql", dsn)
	if err != nil {
		log.Fatal(err)
	}

	err = db.Ping()
	if err != nil {
		log.Fatal(err)
	}

	return db
}

func CheckDBConnection() {
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s",
		os.Getenv("DB_USER"), os.Getenv("DB_PASSWORD"), os.Getenv("DB_HOST"), os.Getenv("DB_PORT"), os.Getenv("DB_NAME"))
	db, err := sql.Open("mysql", dsn)
	if err != nil {
		log.Fatalf("Failed to connect to the database: %v", err)
	}
	defer db.Close()

	err = db.Ping()
	if err != nil {
		log.Fatalf("Failed to ping the database: %v", err)
	}

	log.Println("Successfully connected to the database")
}

func AddVehicle(db *sql.DB, make, model string, year int, status string, assignedTo int, imagePath string) error {
	_, err := db.Exec("INSERT INTO vehicles (make, model, year, status, assigned_to, image_path) VALUES (?, ?, ?, ?, ?, ?)",
		make, model, year, status, assignedTo, imagePath)
	return err
}

func GetAllVehicles(db *sql.DB) ([]auth.Vehicle, error) {
	rows, err := db.Query("SELECT id, make, model, year, status, assigned_to, image_path FROM vehicles")
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	var vehicles []auth.Vehicle
	for rows.Next() {
		var vehicle auth.Vehicle
		if err := rows.Scan(&vehicle.ID, &vehicle.Make, &vehicle.Model, &vehicle.Year, &vehicle.Status, &vehicle.AssignedTo, &vehicle.ImagePath); err != nil {
			return nil, err
		}
		vehicles = append(vehicles, vehicle)
	}
	return vehicles, nil
}

func GetVehicleByID(db *sql.DB, id int) (auth.Vehicle, error) {
	var vehicle auth.Vehicle
	err := db.QueryRow("SELECT id, make, model, year, status, assigned_to, image_path FROM vehicles WHERE id = ?", id).
		Scan(&vehicle.ID, &vehicle.Make, &vehicle.Model, &vehicle.Year, &vehicle.Status, &vehicle.AssignedTo, &vehicle.ImagePath)
	return vehicle, err
}

func UpdateVehicle(db *sql.DB, id int, make, model string, year int, status string, assignedTo int, imagePath string) error {
	_, err := db.Exec("UPDATE vehicles SET make = ?, model = ?, year = ?, status = ?, assigned_to = ?, image_path = ? WHERE id = ?",
		make, model, year, status, assignedTo, imagePath, id)
	return err
}

func DeleteVehicle(db *sql.DB, id int) error {
	_, err := db.Exec("DELETE FROM vehicles WHERE id = ?", id)
	return err
}
