import React, { useState } from 'react';
import styled, { ThemeProvider, DefaultTheme } from 'styled-components';
import logo from '../../assets/logo.png'; 

// --- Color Palette ---
const colors = {
  primary: '#355070',
  backgroundLight: '#F8F9FA', // Main background
  background: '#F2F4F5',      // Content background
  highlight: '#6D597A',
  secondary: '#B56576',
  accent: '#EAAC8B',
};

// --- Styled Components ---
const NavBarContainer = styled.nav`
  width: 100%;
  background-color: ${props => props.theme.primary};
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  top: 0;
  z-index: 10;
`;

const NavLogo = styled.img`
  max-height: 3rem;
  width: auto;
  margin-right: 2rem;
`;

const NavLinks = styled.div<{ isOpen: boolean }>`
  display: flex;

  @media (max-width: 768px) {
    flex-direction: column;
    position: absolute;
    top: 100%;
    right: ${({ isOpen }) => (isOpen ? '0' : '-100%')};
    width: 200px;
    background-color: ${props => props.theme.primary};
    padding: 1rem;
    transition: right 0.3s ease-in-out;
  }
`;

interface NavItemProps {
  active?: boolean;
  theme: DefaultTheme;
}

const NavItem = styled.a<NavItemProps>`
  color: white;
  text-decoration: none;
  padding: 0.7rem 1rem;
  border-radius: 8px;
  margin: 0 0.5rem;
  transition: background-color 0.2s ease, color 0.2s ease;
  font-weight: 500;

  &:hover {
    background-color: ${props => props.theme.secondary};
    color: ${props => props.theme.primary};
  }

  ${({ active, theme }) =>
    active &&
    `
    background-color: ${theme.secondary};
    color: ${theme.primary};
  `}
`;

const HamburgerIcon = styled.button`
  display: none;
  background: none;
  border: none;
  color: white;
  font-size: 24px;
  cursor: pointer;

  @media (max-width: 768px) {
    display: block;
  }
`;

const LoginButton = styled.button`
  background-color: ${props => props.theme.accent};
  color: white;
  padding: 0.7rem 1.5rem; // Adjust padding
  border: none;
  border-radius: 8px; // Adjust border radius
  cursor: pointer;
  transition: background-color 0.2s ease, box-shadow 0.2s ease;

  &:hover {
    background-color: ${props => darken(props.theme.accent, 10)};
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  }
`;

// Function to create hover effect (with fixed operator precedence)
const darken = (color: string, amount: number): string => {
  const num = parseInt(color.replace("#", ""), 16);
  const amt = Math.round(2.55 * amount);
  const R = (num >> 16) - amt;
  const B = ((num >> 8) & 0x00FF) - amt;
  const G = (num & 0x0000FF) - amt;
  return (
    "#" +
    (
      0x1000000 +
      (R < 255 ? (R < 1 ? 0 : R) : 255) * 0x10000 +
      (B < 255 ? (B < 1 ? 0 : B) : 255) * 0x100 +
      (G < 255 ? (G < 1 ? 0 : G) : 255)
    )
      .toString(16)
      .slice(1)
  );
};

const NavBar: React.FC = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [activeItem, setActiveItem] = useState<string>('Home');

  const toggleMenu = () => {
    setIsOpen(!isOpen);
  };

  const handleNavItemClick = (item: string) => {
    setActiveItem(item);
    setIsOpen(false);
  };

  return (
    <ThemeProvider theme={colors}>
      <NavBarContainer>
        <NavLogo src={logo} alt="Fleet Management Logo" />
        <HamburgerIcon onClick={toggleMenu}>&#9776;</HamburgerIcon>
        <NavLinks isOpen={isOpen}>
          <NavItem active={activeItem === 'Home'} onClick={() => handleNavItemClick('Home')}>
            Home
          </NavItem>
          <NavItem active={activeItem === 'Bookings'} onClick={() => handleNavItemClick('Bookings')}>
            Bookings
          </NavItem>
          <NavItem active={activeItem === 'Booking Form'} onClick={() => handleNavItemClick('Booking Form')}>
            Booking Form
          </NavItem>
          <NavItem active={activeItem === 'Notifications'} onClick={() => handleNavItemClick('Notifications')}>
            Notifications
          </NavItem>
          <NavItem active={activeItem === 'Trip History'} onClick={() => handleNavItemClick('Trip History')}>
            Trip History
          </NavItem>
          <NavItem active={activeItem === 'Support and Help'} onClick={() => handleNavItemClick('Support and Help')}>
            Support and Help
          </NavItem>
          <LoginButton onClick={() => handleNavItemClick('Login')}>Login</LoginButton>
        </NavLinks>
      </NavBarContainer>
    </ThemeProvider>
  );
};

export default NavBar;
