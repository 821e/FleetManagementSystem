package main

import (
	"FMSBackend/config"
	"FMSBackend/controllers"
	"FMSBackend/services"
	"log"

	"github.com/gin-gonic/gin"
)

func main() {
	config.LoadConfig()
	services.InitDB()

	router := gin.Default()

	authGroup := router.Group("/auth")
	{
		authGroup.POST("/login", controllers.Login)
		authGroup.POST("/admin/login", controllers.AdminLogin)
	}

	log.Fatal(router.Run(":8080"))
}
