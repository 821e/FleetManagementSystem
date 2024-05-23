import React from 'react';
import styled from 'styled-components';

// Define your color palette
const colors = {
  primary: '#CCD5AE',
  background: '#E9EDC9',
  highlight: '#FEFAE0',
  secondary: '#FAEDCD',
  accent: '#D4A373'
};

// Styled Components
const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;  // Add some padding
  text-align: center;
  background-color: ${colors.secondary};  // Set background color
`;

const Title = styled.h1`
  font-size: 3em;
  color: ${colors.primary};
  margin-bottom: 20px;  // Add space below title
`;

const Subtitle = styled.p`
  font-size: 1.2em;
  color: ${colors.accent};
  margin-bottom: 30px;  // Add space below subtitle
`;

// Example button (customize as needed)
const Button = styled.button`
  background-color: ${colors.primary};
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  &:hover {
    background-color: darken(${colors.primary}, 10%); // Darken on hover
  }
`;

const Home: React.FC = () => {
  return (
    <Container>
      <Title>Welcome to the Fleet Management System!</Title>
      <Subtitle>Manage your vehicles and drivers efficiently.</Subtitle>
      <Button>Get Started</Button> 
      {/* Add more content or components here as needed */}
    </Container>
  );
};

export default Home;
