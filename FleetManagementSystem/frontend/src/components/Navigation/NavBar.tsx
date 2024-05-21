import React, { useState } from 'react';
import styled, { keyframes } from 'styled-components';

const NavBarContainer = styled.nav`
  width: 100%;
  background-color: #2c3e50;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: relative;
`;

const NavItem = styled.a<{ active?: boolean }>`
  float: left;
  display: block;
  color: ${({ active }) => (active ? '#4CAF50' : 'white')};
  text-align: center;
  padding: 16px 20px;
  text-decoration: none;
  font-size: 18px;
  transition: all 0.3s ease-in-out;

  ${({ active }) => active && `
    border-bottom: 3px solid #4CAF50;
  `}

  &:hover {
    color: #4CAF50;
    background-color: #ecf0f1;
  }
`;

const HamburgerIcon = styled.div`
  display: none;
  float: right;
  font-size: 30px;
  cursor: pointer;
  color: white;

  @media (max-width: 600px) {
    display: block;
  }
`;

const NavLinks = styled.div<{ isOpen: boolean }>`
  @media (max-width: 600px) {
    display: ${({ isOpen }) => (isOpen ? 'block' : 'none')};
    width: 100%;
    float: none;

    ${NavItem} {
      float: none;
      text-align: left;
      padding: 12px 16px;
    }
  }
`;

const fadeIn = keyframes`
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
`;

const AnimatedNavItem = styled(NavItem)`
  animation: ${fadeIn} 0.5s ease-in-out;
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
      <HamburgerIcon onClick={toggleMenu}>&#9776;</HamburgerIcon>
      <NavLinks isOpen={isOpen}>
        <AnimatedNavItem active={activeItem === 'Home'} onClick={() => handleNavItemClick('Home')}>Home</AnimatedNavItem>
        <AnimatedNavItem active={activeItem === 'About'} onClick={() => handleNavItemClick('About')}>About</AnimatedNavItem>
        <AnimatedNavItem active={activeItem === 'Services'} onClick={() => handleNavItemClick('Services')}>Services</AnimatedNavItem>
        <AnimatedNavItem active={activeItem === 'Contact'} onClick={() => handleNavItemClick('Contact')}>Contact</AnimatedNavItem>
        <AnimatedNavItem active={activeItem === 'Login'} onClick={() => handleNavItemClick('Login')} style={{ float: 'right' }}>Login</AnimatedNavItem>
      </NavLinks>
    </NavBarContainer>
  );
};

export default NavBar;
