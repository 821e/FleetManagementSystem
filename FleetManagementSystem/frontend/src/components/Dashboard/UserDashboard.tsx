import React from 'react';
import UserSidebar from './UserSidebar';
import './DashboardLayout.css';

interface UserDashboardProps {
  isSidebarOpen: boolean;
  toggleSidebar: () => void;
}

const UserDashboard: React.FC<UserDashboardProps> = ({ isSidebarOpen, toggleSidebar }) => {
  return (
    <div className="dashboard">
      <button className="toggle-button" onClick={toggleSidebar}>
        &#9776;
      </button>
      <UserSidebar isOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
      <div className={`content ${isSidebarOpen ? 'sidebar-open' : ''}`}>
        <h1>User Dashboard</h1>
        {/* Add more content here */}
      </div>
    </div>
  );
};

export default UserDashboard;
