import React, { useContext } from 'react';
import UserSidebar from './UserSidebar';
import './DashboardLayout.css';
import { AuthContext } from '../../App';
import styled from 'styled-components';
import { FaHome, FaCar, FaCalendar, FaUser, FaClipboardList, FaCogs, FaBoxes } from 'react-icons/fa';
import { Link as RouterLink } from 'react-router-dom';
import { Icon, Text } from '@chakra-ui/react';

const LogoutButton = styled.button`
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: #DC143C;
  color: #FFFFFF;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease;

  &:hover {
    background-color: #b0102c;
  }
`;

const DashboardBox = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 150px;
  height: 150px;
  margin: 20px;
  background-color: #f0f0f0;
  border-radius: 10px;
  transition: transform 0.3s ease;
  &:hover {
    transform: scale(1.05);
  }
`;

const IconWrapper = styled.div`
  font-size: 40px;
  margin-bottom: 10px;
`;

const DashboardGrid = styled.div`
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
`;

const menuItems = [
  { label: 'Dashboard', icon: FaHome, to: '/user/dashboard' },
  { label: 'Task Management', icon: FaCalendar, to: '/user/task-management' },
  { label: 'Vehicle Information', icon: FaCar, to: '/user/vehicle-info' },
  { label: 'Route Management', icon: FaCalendar, to: '/user/route-management' },
  { label: 'Fuel Management', icon: FaBoxes, to: '/user/fuel-management' },
  { label: 'Maintenance Reporting', icon: FaClipboardList, to: '/user/maintenance-reporting' },
  { label: 'Communication', icon: FaUser, to: '/user/communication' },
  { label: 'Profile Management', icon: FaUser, to: '/user/profile-management' },
  { label: 'Compliance & Documentation', icon: FaClipboardList, to: '/user/compliance-docs' },
  { label: 'Support', icon: FaCogs, to: '/user/support' },
];

const UserDashboard: React.FC<{ isSidebarOpen: boolean, toggleSidebar: () => void }> = ({ isSidebarOpen, toggleSidebar }) => {
  const context = useContext(AuthContext);

  const handleLogout = () => {
    context?.setAuth({ isLoggedIn: false, role: '' });
  };

  return (
    <div className="dashboard">
      <UserSidebar isOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />
      <div className={`content ${isSidebarOpen ? 'sidebar-open' : ''}`}>
        <LogoutButton onClick={handleLogout}>Logout</LogoutButton>
        <h1>User Dashboard</h1>
        <DashboardGrid>
          {menuItems.map((item, index) => (
            <DashboardBox key={index} as={RouterLink} to={item.to}>
              <IconWrapper>
                <Icon as={item.icon} />
              </IconWrapper>
              <Text>{item.label}</Text>
            </DashboardBox>
          ))}
        </DashboardGrid>
      </div>
    </div>
  );
};

export default UserDashboard;
