import React, { useState } from 'react';
import AdminDashboard from './AdminDashboard';
import UserDashboard from './UserDashboard';
import './DashboardLayout.css';

interface DashboardLayoutProps {
  isAdmin: boolean;
}

const DashboardLayout: React.FC<DashboardLayoutProps> = ({ isAdmin }) => {
  const [isSidebarOpen, setSidebarOpen] = useState(false);

  const toggleSidebar = () => {
    setSidebarOpen(!isSidebarOpen);
  };

  return (
    <div className="dashboard-layout">
      {isAdmin ? (
        <AdminDashboard isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
      ) : (
        <UserDashboard isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
      )}
    </div>
  );
};

export default DashboardLayout;
