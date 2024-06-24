import React from 'react';
import {
  Box, Icon, Link, Text, VStack, Drawer, DrawerOverlay,
  DrawerContent, DrawerHeader, DrawerBody, useBreakpointValue, Button
} from '@chakra-ui/react';
import { FaHome, FaCar, FaCalendar, FaChartBar, FaUser, FaBoxes, FaBars, FaCogs, FaUsers, FaClipboardList } from 'react-icons/fa';
import { Link as RouterLink } from 'react-router-dom';
import styled from '@emotion/styled';

const colors = {
  primary: '#000000',
  background: '#FFFFFF',
  accent: '#DC143C',
};

const menuCategories = [
  {
    category: 'Main',
    items: [
      { label: 'Dashboard', icon: FaHome, to: '/admin/dashboard' },
      { label: 'Vehicle Management', icon: FaCar, to: '/admin/vehicle-management' },
      { label: 'Driver Management', icon: FaUser, to: '/admin/driver-management' },
      { label: 'Maintenance Management', icon: FaCalendar, to: '/admin/maintenance-management' },
      { label: 'Route Management', icon: FaCalendar, to: '/admin/route-management' },
      { label: 'Fuel Management', icon: FaBoxes, to: '/admin/fuel-management' },
    ],
  },
  {
    category: 'Reporting',
    items: [
      { label: 'Reporting & Analytics', icon: FaChartBar, to: '/admin/reporting-analytics' },
      { label: 'Compliance & Documentation', icon: FaClipboardList, to: '/admin/compliance-docs' },
    ],
  },
  {
    category: 'Settings',
    items: [
      { label: 'User Management', icon: FaUsers, to: '/admin/user-management' },
      { label: 'Settings', icon: FaCogs, to: '/admin/settings' },
      { label: 'Alerts & Notifications', icon: FaClipboardList, to: '/admin/alerts-notifications' },
    ],
  },
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

const AdminSidebar = ({ isOpen, toggleSidebar }: { isOpen: boolean; toggleSidebar: () => void }) => {
  const isMobile = useBreakpointValue({ base: true, md: false });

  return (
    <>
      <SidebarContainer isOpen={isOpen}>
        <VStack spacing={4} align="start" mt={5}>
          <SidebarItem as={Button} onClick={toggleSidebar} bg="transparent" _hover={{ bg: colors.accent }}>
            <Icon as={FaBars} mr={isOpen ? 3 : 0} />
            {isOpen && "Menu"}
          </SidebarItem>
          {menuCategories.map((category, catIndex) => (
            <React.Fragment key={catIndex}>
              {isOpen && <Text fontSize="lg" color={colors.background} pl={5} pt={5}>{category.category}</Text>}
              {category.items.map((item, index) => (
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
            </React.Fragment>
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
                {menuCategories.map((category, catIndex) => (
                  <React.Fragment key={catIndex}>
                    <Text fontSize="lg" color={colors.background} pl={5} pt={5}>{category.category}</Text>
                    {category.items.map((item, index) => (
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
                  </React.Fragment>
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