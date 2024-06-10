import React from 'react';
import styled from 'styled-components';

// --- Color Palette ---
const colors = {
  primary: '#000000',      // Black for text
  background: '#FFFFFF',   // White for background
  accent: '#DC143C',       // Crimson Red for accents
};

// --- Styled Components ---
const HomeContainer = styled.div`
  background-color: ${colors.background}; // White background
  color: ${colors.primary}; // Black text
  padding: 2rem;
  text-align: center;
  font-family: 'Roboto', sans-serif; // Using Roboto for a modern look
  min-height: 100vh; // Full screen height
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
`;

const WelcomeMessage = styled.h1`
  font-size: 2.5rem;
  color: ${colors.accent}; // Crimson Red for emphasis
  margin-bottom: 20px;
`;

const Description = styled.p`
  font-size: 1.2rem;
  margin-bottom: 15px;
`;

const GetStartedButton = styled.button`
  padding: 10px 20px;
  background-color: ${colors.accent}; // Crimson Red background
  color: ${colors.background}; // White text
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: background-color 0.3s ease;

  &:hover {
    background-color: darken(${colors.accent}, 10%);
  }
`;

const Home = () => {
  return (
    <HomeContainer>
      <WelcomeMessage>Welcome to FleetManager</WelcomeMessage>
      <Description>Manage your fleet efficiently and enhance operational effectiveness with our comprehensive toolset.</Description>
      <GetStartedButton>Get Started</GetStartedButton>
    </HomeContainer>
  );
};

export default Home;
