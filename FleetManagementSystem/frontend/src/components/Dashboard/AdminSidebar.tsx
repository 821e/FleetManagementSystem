import React from 'react';
import {
  Box, Icon, Link, Text, VStack, Button, Drawer, DrawerOverlay,
  DrawerContent, DrawerHeader, DrawerBody, useBreakpointValue
} from '@chakra-ui/react';
import { FaHome, FaCar, FaCalendar, FaChartBar, FaUser, FaBoxes, FaBars } from 'react-icons/fa';
import { Link as RouterLink } from 'react-router-dom';
import styled from '@emotion/styled';

const colors = {
  primary: '#000000',      // Black
  background: '#FFFFFF',   // White
  accent: '#DC143C',       // Crimson Red
};

const menuItems = [
  { label: 'Dashboard', icon: FaHome, to: '/dashboard/admin-dashboard' },
  { label: 'Orders', icon: FaBoxes, to: '/dashboard/admin-dashboard/orders' },
  { label: 'Statistics', icon: FaChartBar, to: '/dashboard/admin-dashboard/statistics' },
  { label: 'Products', icon: FaCar, to: '/dashboard/admin-dashboard/products' },
  { label: 'Stock', icon: FaCalendar, to: '/dashboard/admin-dashboard/stock' },
  { label: 'Offers', icon: FaUser, to: '/dashboard/admin-dashboard/offers' },
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

const SidebarToggleButton = styled(Button)`
  background-color: ${colors.primary};
  color: ${colors.background};
  width: 100%;
  text-align: left;
  padding: 10px 20px;
  margin-bottom: 20px;
  &:hover {
    background-color: ${colors.accent};
  }
`;

const AdminSidebar = ({ isOpen, toggleSidebar }: { isOpen: boolean; toggleSidebar: () => void }) => {
  const isMobile = useBreakpointValue({ base: true, md: false });

  return (
    <>
      <SidebarContainer isOpen={isOpen}>
        <VStack spacing={4} align="start" mt={5}>
          <SidebarToggleButton onClick={toggleSidebar}>
            <Icon as={FaBars} mr={isOpen ? 3 : 0} />
            {isOpen && "Menu"}
          </SidebarToggleButton>
          {isOpen && (
            <Text fontSize="2xl" color={colors.background} pl={5} pb={5}>Admin Dashboard</Text>
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

export default AdminSidebar;
