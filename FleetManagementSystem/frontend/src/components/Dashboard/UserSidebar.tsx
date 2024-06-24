import React from 'react';
import {
  Box, Icon, Link, Text, VStack, Drawer, DrawerOverlay,
  DrawerContent, DrawerHeader, DrawerBody, useBreakpointValue, Button
} from '@chakra-ui/react';
import { FaHome, FaCar, FaCalendar, FaUser, FaBars, FaCogs, FaClipboardList } from 'react-icons/fa';
import { Link as RouterLink } from 'react-router-dom';
import styled from '@emotion/styled';

const colors = {
  primary: '#000000', // Black
  background: '#FFFFFF', // White
  accent: '#DC143C', // Crimson Red
};

const menuItems = [
  { label: 'Dashboard', icon: FaHome, to: '/user/dashboard' },
  { label: 'Task Management', icon: FaCalendar, to: '/user/task-management' },
  { label: 'Vehicle Information', icon: FaCar, to: '/user/vehicle-info' },
  { label: 'Route Management', icon: FaCalendar, to: '/user/route-management' },
  { label: 'Fuel Management', icon: FaClipboardList, to: '/user/fuel-management' },
  { label: 'Maintenance Reporting', icon: FaClipboardList, to: '/user/maintenance-reporting' },
  { label: 'Communication', icon: FaUser, to: '/user/communication' },
  { label: 'Profile Management', icon: FaUser, to: '/user/profile-management' },
  { label: 'Compliance & Documentation', icon: FaClipboardList, to: '/user/compliance-docs' },
  { label: 'Support', icon: FaCogs, to: '/user/support' },
];

const SidebarContainer = styled(Box)<{ isOpen: boolean }>`
  background-color: ${colors.primary};
  color: ${colors.background};
  width: ${props => (props.isOpen ? '250px' : '60px')};
  height: 100vh;
  padding-top: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: width 0.3s ease;
`;

const SidebarItem = styled(Link)`
  display: flex;
  align-items: center;
  padding: 15px 20px;
  color: ${colors.background};
  text-decoration: none;
  transition: background-color 0.3s ease, transform 0.3s ease;
  &:hover {
    background-color: ${colors.accent};
    color: ${colors.background};
    transform: translateX(10px);
  }
`;

const UserSidebar = ({ isOpen, toggleSidebar }: { isOpen: boolean; toggleSidebar: () => void }) => {
  const isMobile = useBreakpointValue({ base: true, md: false });

  return (
    <>
      <SidebarContainer isOpen={isOpen}>
        <VStack spacing={4} align="start" mt={5}>
          <SidebarItem as={Button} onClick={toggleSidebar} bg="transparent" _hover={{ bg: colors.accent }}>
            <Icon as={FaBars} mr={isOpen ? 3 : 0} />
            {isOpen && "Menu"}
          </SidebarItem>
          {isOpen && (
            <Text fontSize="2xl" color={colors.background} pl={5} pb={5}>Operation Dashboard</Text>
          )}
          {menuItems.map((item, index) => (
            <SidebarItem
              key={index}
              as={RouterLink}
              to={item.to}
              display="flex"
              alignItems="center"
              p={3}
              w="100%"
              color={colors.background}
              textDecoration="none"
              _hover={{ bg: colors.accent }}
            >
              <Icon as={item.icon} />
              {isOpen && <Text ml={3}>{item.label}</Text>}
            </SidebarItem>
          ))}
        </VStack>
      </SidebarContainer>

      {isMobile && (
        <Drawer isOpen={isOpen} placement="left" onClose={toggleSidebar}>
          <DrawerOverlay />
          <DrawerContent bg={colors.primary} color={colors.background}>
            <DrawerHeader>
              <Button onClick={toggleSidebar} bg="transparent" _hover={{ bg: colors.accent }}>
                <Icon as={FaBars} />
              </Button>
            </DrawerHeader>
            <DrawerBody>
              <VStack spacing={4} align="start">
                {menuItems.map((item, index) => (
                  <Link
                    key={index}
                    as={RouterLink}
                    to={item.to}
                    display="flex"
                    alignItems="center"
                    p={3}
                    w="100%"
                    color={colors.background}
                    textDecoration="none"
                    _hover={{ bg: colors.accent }}
                    onClick={toggleSidebar}
                  >
                    <Icon as={item.icon} />
                    <Text ml={3}>{item.label}</Text>
                  </Link>
                ))}
              </VStack>
            </DrawerBody>
          </DrawerContent>
        </Drawer>
      )}
    </>
  );
};

export default UserSidebar;