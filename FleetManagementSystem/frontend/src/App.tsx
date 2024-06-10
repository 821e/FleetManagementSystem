import React, { createContext, useContext, useState, ReactNode } from 'react';
import { BrowserRouter as Router, Route, Routes, Navigate } from 'react-router-dom';
import AdminDashboard from './components/Dashboard/AdminDashboard';
import UserDashboard from './components/Dashboard/UserDashboard';
import Login from './pages/Login';

interface AuthContextType {
  auth: { isLoggedIn: boolean; role: string };
  setAuth: React.Dispatch<React.SetStateAction<{ isLoggedIn: boolean; role: string }>>;
}

// Create a context for authentication
const AuthContext = createContext<AuthContextType | null>(null);

const App = () => {
  const [auth, setAuth] = useState({ isLoggedIn: false, role: '' });

  const toggleSidebar = () => {
    // Implement your toggle sidebar logic here
  };

  return (
    <AuthContext.Provider value={{ auth, setAuth }}>
      <Router>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route
            path="/dashboard/admin-dashboard"
            element={
              <ProtectedRoute role="admin">
                <AdminDashboard isSidebarOpen={true} toggleSidebar={toggleSidebar} />
              </ProtectedRoute>
            }
          />
          <Route
            path="/dashboard/user-dashboard"
            element={
              <ProtectedRoute role="user">
                <UserDashboard isSidebarOpen={true} toggleSidebar={toggleSidebar} />
              </ProtectedRoute>
            }
          />
          <Route path="*" element={<Navigate to="/login" />} />
        </Routes>
      </Router>
    </AuthContext.Provider>
  );
};

// Protected route component
interface ProtectedRouteProps {
  role: string;
  children: ReactNode;
}

const ProtectedRoute = ({ role, children }: ProtectedRouteProps) => {
  const context = useContext(AuthContext);

  if (!context) {
    return <Navigate to="/login" />;
  }

  const { auth } = context;

  if (!auth.isLoggedIn || auth.role !== role) {
    return <Navigate to="/login" />;
  }

  return <>{children}</>;
};

export { AuthContext };
export default App;
