package vehicle

type Vehicle struct {
	ID         int    `json:"id"`
	Make       string `json:"make"`
	Model      string `json:"model"`
	Year       int    `json:"year"`
	Status     string `json:"status"`
	AssignedTo int    `json:"assigned_to"` // Assuming a user ID
}
