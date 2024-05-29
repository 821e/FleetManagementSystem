package services

import (
	"FMSBackend/config"
	"FMSBackend/utils"
	"database/sql"
	"errors"
	"fmt"

	_ "github.com/go-sql-driver/mysql"
)

var db *sql.DB

func InitDB() {
	var err error
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s",
		config.DBUser, config.DBPassword, config.DBHost, config.DBPort, config.DBName)
	db, err = sql.Open("mysql", dsn)
	if err != nil {
		panic(err)
	}

	// Test the connection
	err = db.Ping()
	if err != nil {
		panic(err)
	}
}

func AuthenticateUser(username, password string) (string, error) {
	var storedPassword string
	err := db.QueryRow("SELECT password FROM users WHERE username = ?", username).Scan(&storedPassword)
	if err != nil {
		return "", errors.New("user not found")
	}

	if storedPassword != password {
		return "", errors.New("incorrect password")
	}

	token, err := utils.GenerateToken(username)
	if err != nil {
		return "", err
	}

	return token, nil
}

func AuthenticateAdmin(adminCode, username, password string) (string, error) {
	var storedPassword string
	err := db.QueryRow("SELECT password FROM admins WHERE admin_code = ? AND username = ?", adminCode, username).Scan(&storedPassword)
	if err != nil {
		return "", errors.New("admin not found")
	}

	if storedPassword != password {
		return "", errors.New("incorrect password")
	}

	token, err := utils.GenerateToken(username)
	if err != nil {
		return "", err
	}

	return token, nil
}
