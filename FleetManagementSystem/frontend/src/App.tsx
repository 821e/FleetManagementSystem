import React, { createContext, useContext, useState, ReactNode } from 'react';
import { BrowserRouter as Router, Route, Routes, Navigate } from 'react-router-dom';
import AdminDashboard from './components/Dashboard/AdminDashboard';
import UserDashboard from './components/Dashboard/UserDashboard';
import Login from './pages/Login';
import AdminVehicleManager from './components/Vehicle/AdminVehicleManager';
import UserVehicleViewer from './components/Vehicle/UserVehicleViewer';

interface AuthContextType {
  auth: { isLoggedIn: boolean; role: string };
  setAuth: React.Dispatch<React.SetStateAction<{ isLoggedIn: boolean; role: string }>>;
}

export const AuthContext = createContext<AuthContextType | null>(null);

const App = () => {
  const [auth, setAuth] = useState({ isLoggedIn: false, role: '' });
  const [isSidebarOpen, setIsSidebarOpen] = useState(false);

  const toggleSidebar = () => {
    setIsSidebarOpen(!isSidebarOpen);
  };

  return (
    <AuthContext.Provider value={{ auth, setAuth }}>
      <Router>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route
            path="/admin/dashboard"
            element={
              <ProtectedRoute role="admin">
                <AdminDashboard isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
              </ProtectedRoute>
            }
          />
          <Route
            path="/user/dashboard"
            element={
              <ProtectedRoute role="user">
                <UserDashboard isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
              </ProtectedRoute>
            }
          />
          <Route
            path="/admin/vehicle-management"
            element={
              <ProtectedRoute role="admin">
                <AdminVehicleManager />
              </ProtectedRoute>
            }
          />
          <Route
            path="/user/vehicle-info"
            element={
              <ProtectedRoute role="user">
                <UserVehicleViewer />
              </ProtectedRoute>
            }
          />
          <Route path="*" element={<Navigate to="/login" />} />
        </Routes>
      </Router>
    </AuthContext.Provider>
  );
};

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

export default App;
