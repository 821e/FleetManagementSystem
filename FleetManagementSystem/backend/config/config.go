package config

import (
	"log"
	"os"

	"github.com/joho/godotenv"
)

var (
	DBUser     string
	DBPassword string
	DBName     string
	DBHost     string
	DBPort     string
	SecretKey  string
)

func LoadConfig() {
	err := godotenv.Load()
	if err != nil {
		log.Fatal("Error loading .env file")
	}

	DBUser = os.Getenv("DB_USER")
	DBPassword = os.Getenv("DB_PASSWORD")
	DBName = os.Getenv("DB_NAME")
	DBHost = os.Getenv("DB_HOST")
	DBPort = os.Getenv("DB_PORT")
	SecretKey = os.Getenv("SECRET_KEY")
}
