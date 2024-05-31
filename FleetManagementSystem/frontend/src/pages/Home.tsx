import React from 'react';
import styled, { ThemeProvider } from 'styled-components';

// --- Color Palette ---
const colors = {
  primary: '#4D6A79',       // Dark blue from the truck
  backgroundLight: '#F0F4F5', // Very light grey
  background: '#E5E9EB',    // Slightly darker grey
  highlight: '#7390A2',     // Medium blue
  secondary: '#637B8C',     // Medium-dark blue
  accent: '#A3B0B9',        // Light blue-grey
};

// Function to create hover effect
const darken = (color: string, amount: number): string => {
  const num = parseInt(color.replace("#", ""), 16);
  const amt = Math.round(2.55 * amount);
  const R = (num >> 16) - amt;
  const B = ((num >> 8) & 0x00FF) - amt;
  const G = (num & 0x0000FF) - amt;
  return "#" + (0x1000000 + (R < 255 ? R < 1 ? 0 : R : 255) * 0x10000 + (B < 255 ? B < 1 ? 0 : B : 255) * 0x100 + (G < 255 ? G < 1 ? 0 : G : 255)).toString(16).slice(1);
};

// --- Styled Components ---
const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.8); // Slight white overlay for readability
`;

const ContentArea = styled.div`
  background-color: ${props => props.theme.background};
  padding: 30px;
  border-radius: 8px;
`;

const Title = styled.h1`
  font-size: 3em;
  color: ${props => props.theme.primary};
  margin-bottom: 20px;
`;

const Subtitle = styled.p`
  font-size: 1.2em;
  color: ${props => props.theme.secondary};
  margin-bottom: 30px;
`;

const Button = styled.button`
  background-color: ${props => props.theme.highlight};
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;

  &:hover {
    background-color: ${props => darken(props.theme.highlight, 10)};
  }
`;

const Home: React.FC = () => {
  return (
    <ThemeProvider theme={colors}>
      <Container>
        <ContentArea>
          <Title>Welcome to the Fleet Management System!</Title>
          <Subtitle>Manage your vehicles and drivers efficiently.</Subtitle>
          <Button>Get Started</Button>
        </ContentArea>
      </Container>
    </ThemeProvider>
  );
};

export default Home;
