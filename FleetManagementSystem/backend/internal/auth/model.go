package auth

type Credentials struct {
	Username string `json:"username"`
	Password string `json:"password"`
	Role     string `json:"role"` // Add role field
}

type Vehicle struct {
	ID         int    `json:"id"`
	Make       string `json:"make"`
	Model      string `json:"model"`
	Year       int    `json:"year"`
	Status     string `json:"status"`
	AssignedTo int    `json:"assigned_to"` // Assuming a user ID
	ImagePath  string `json:"image_path"`  // New field for image path
}
