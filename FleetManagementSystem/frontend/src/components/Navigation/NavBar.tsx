import React, { useState } from 'react';
import styled from 'styled-components';
import logo from '../../assets/logo.png'; 

// Color Palette (Subtle Adjustments for a Softer Look)
const colors = {
  primary: '#CCD5AE',
  background: '#E9EDC9',
  highlight: '#FEFAE0',
  secondary: '#FAEDCD',
  accent: '#D4A373'
};

// Styling
const NavBarContainer = styled.nav`
  width: 100%;
  background-color: ${colors.primary}; 
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed; // Make navbar fixed
  top: 0;
  z-index: 10; // Ensure it's above other content
`;

const NavLogo = styled.img`
  max-height: 3rem;
  width: auto;
  margin-right: 2rem; // Add space to the right of the logo
`;

const NavLinks = styled.div<{ isOpen: boolean }>`
  display: flex;

  @media (max-width: 768px) {
    flex-direction: column;
    position: absolute;
    top: 100%; 
    right: ${({ isOpen }) => (isOpen ? '0' : '-100%')};
    width: 200px;
    background-color: ${colors.primary};
    padding: 1rem; 
    transition: right 0.3s ease-in-out;
  }
`;

const NavItem = styled.a<{ active?: boolean }>`
  color: white; 
  text-decoration: none;
  padding: 0.7rem 1rem;
  border-radius: 8px;
  margin: 0 0.5rem;
  transition: background-color 0.2s ease, color 0.2s ease;
  font-weight: 500;

  &:hover {
    background-color: ${colors.secondary}; 
    color: ${colors.primary}; 
  }

  ${({ active }) => active && `
    background-color: ${colors.secondary}; 
    color: ${colors.primary}; 
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
  background-color: ${colors.accent}; 
  color: white;
  padding: 0.7rem 1.5rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s ease, box-shadow 0.2s ease;

  &:hover {
    background-color: darken(${colors.accent}, 10%); 
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); // Add a hover shadow
  }
`;
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
    <NavBarContainer>
      <NavLogo src={logo} alt="Fleet Management Logo" /> 
      <HamburgerIcon onClick={toggleMenu}>&#9776;</HamburgerIcon>
      <NavLinks isOpen={isOpen}>
        <NavItem active={activeItem === 'Home'} onClick={() => handleNavItemClick('Home')}>Home</NavItem>
        <NavItem active={activeItem === 'Bookings'} onClick={() => handleNavItemClick('Bookings')}>Bookings</NavItem>
        <NavItem active={activeItem === 'Booking Form'} onClick={() => handleNavItemClick('Booking Form')}>Booking Form</NavItem>
        <NavItem active={activeItem === 'Notifications'} onClick={() => handleNavItemClick('Notifications')}>Notifications</NavItem>
        <NavItem active={activeItem === 'Trip History'} onClick={() => handleNavItemClick('Trip History')}>Trip History</NavItem>
        <NavItem active={activeItem === 'Support and Help'} onClick={() => handleNavItemClick('Support and Help')}>Bookings</NavItem>
        <NavItem active={activeItem === 'Support and Help'} onClick={() => handleNavItemClick('Support and Help')}>Bookings</NavItem>
        <NavItem active={activeItem === 'Support and Help'} onClick={() => handleNavItemClick('Support and Help')}>Bookings</NavItem>



        <LoginButton onClick={() => handleNavItemClick('Login')}>Login</LoginButton> 
      </NavLinks>
    </NavBarContainer>
  );
};

export default NavBar;
