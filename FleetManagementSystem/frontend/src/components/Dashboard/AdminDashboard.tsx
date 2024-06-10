import React from 'react';
import AdminSidebar from './AdminSidebar';
import './DashboardLayout.css';

interface AdminDashboardProps {
  isSidebarOpen: boolean;
  toggleSidebar: () => void;
}

const AdminDashboard: React.FC<AdminDashboardProps> = ({ isSidebarOpen, toggleSidebar }) => {
  return (
    <div className="dashboard">
      <AdminSidebar isOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
      <div className={`content ${isSidebarOpen ? 'sidebar-open' : ''}`}>
        <h1>Admin Dashboard</h1>
        {/* Add more content here */}
      </div>
    </div>
  );
};

export default AdminDashboard;
