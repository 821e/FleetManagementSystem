import React, { useState } from 'react';
import styled, { keyframes, ThemeProvider } from 'styled-components';

// --- Color Palette ---
const colors = {
  primary: '#355070',
  backgroundLight: '#F8F9FA', // Main background
  background: '#FFFFFF',      // Content background (adjusted to pure white)
  highlight: '#6D597A',
  secondary: '#B56576',
  accent: '#EAAC8B',
};

// --- Keyframe Animations ---
const float = keyframes`
  0% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
  100% { transform: translateY(0); }
`;

const maskAnimation = keyframes`  
  from {
    -webkit-mask-position: 0 0;
    mask-position: 0 0;
  }
  to {
    -webkit-mask-position: 100% 0;
    mask-position: 100% 0;
  }
`;

// Function to create hover effect (with fixed operator precedence)
const darken = (color: string, amount: number): string => {
  const num = parseInt(color.replace("#", ""), 16);
  const amt = Math.round(2.55 * amount);
  const R = (num >> 16) - amt;
  const B = ((num >> 8) & 0x00FF) - amt; // Added parentheses for clarity
  const G = (num & 0x0000FF) - amt;
  return "#" + (0x1000000 + (R < 255 ? R < 1 ? 0 : R : 255) * 0x10000 + (B < 255 ? B < 1 ? 0 : B : 255) * 0x100 + (G < 255 ? G < 1 ? 0 : G : 255)).toString(16).slice(1);
};

// --- Styled Components ---

const Container = styled.div`
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: radial-gradient(circle at center, ${props => props.theme.backgroundLight} 50%, ${props => props.theme.primary});
`;

const Card = styled.div`
  background-color: ${props => props.theme.background};
  padding: 50px; /* Increased padding for more breathing room */
  border-radius: 25px; /* Slightly rounder corners */
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow */
  width: 450px;
  text-align: center;
  animation: ${float} 4s ease-in-out infinite; /* Gentle floating animation */
`;

const Title = styled.h1`
  color: ${props => props.theme.primary}; /* Title color aligned with primary */
  margin-bottom: 40px; /* Increased margin */
  font-size: 2.5em;  /* Adjusted title size */
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
`;

const Input = styled.input`
  width: 100%;
  padding: 15px;
  margin: 10px 0;
  border: 1px solid ${props => props.theme.primary};
  border-radius: 8px;
  background-color: ${props => props.theme.backgroundLight};
  color: ${props => props.theme.primary};
  &:focus {
    outline: none;
    border-color: ${props => props.theme.accent};
  }
`;

const Button = styled.button`
  background-color: ${props => props.theme.accent};
  color: white;
  padding: 15px 30px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1em;
  font-weight: bold; /* Add some weight to the text */
  transition: background-color 0.3s ease, transform 0.2s ease; /* Smoother hover transition */

  &:hover {
    transform: translateY(-2px); /* Lift up slightly on hover */
    background-color: ${props => darken(props.theme.accent, 10)};
  }

  // --- Mask Animation ---
  position: relative;
  overflow: hidden;
  z-index: 1;
  
  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, ${props => props.theme.primary} 0%, ${props => props.theme.secondary} 100%); /* Gradient mask */
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    z-index: -1;
  }

  &:hover::before {
    transform: translateX(0);
    animation: ${maskAnimation} 0.8s steps(20) 1 forwards;
  }
`;

const AdminCard = styled(Card)` /* Inherit styles from Card */
  width: 500px; /* Wider for additional admin fields */
`;

const RoleToggle = styled.button`
  background: none;
  border: none;
  color: ${props => props.theme.accent};
  text-decoration: underline;
  cursor: pointer;
  font-size: 0.9em;
  margin-top: 10px; /* Adjust spacing as needed */
`;

const RoleToggleContainer = styled.div`
  display: flex;
  justify-content: center;
  margin-top: 20px;

  button {
    background-color: transparent;
    border: none;
    color: ${props => props.theme.accent};
    text-decoration: underline;
    cursor: pointer;
    font-size: 1em;
    transition: color 0.3s ease;

    &:hover {
      color: ${props => props.theme.secondary};
    }

    & + button {
      margin-left: 20px; 
    }
  }
`;

const App = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [isAdminView, setIsAdminView] = useState(false);

  const handleSubmit = (role: string) => {
    // Handle login logic based on role
    console.log("Submitted:", username, password, role);
  };

  return (
    <ThemeProvider theme={colors}>
      <Container>
        {isAdminView ? (
          <AdminCard>
            <Title>Admin Login</Title>
            <Input type="text" placeholder="Admin Code" />
            <Input type="text" placeholder="Username" value={username} onChange={(e) => setUsername(e.target.value)} />
            <Input type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)} />
            <Button onClick={() => handleSubmit('admin')}>Login as Admin</Button>
            <RoleToggleContainer>  
              <RoleToggle onClick={() => setIsAdminView(false)}>Login as User</RoleToggle>
            </RoleToggleContainer>
          </AdminCard>
        ) : (
          <Card>
            <Title>User Login</Title>
            <Input type="text" placeholder="Username" value={username} onChange={(e) => setUsername(e.target.value)} />
            <Input type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)} />
            <Button onClick={() => handleSubmit('user')}>Login</Button>
            <RoleToggleContainer>
              <RoleToggle onClick={() => setIsAdminView(true)}>Login as Admin</RoleToggle> 
            </RoleToggleContainer>
          </Card>
        )}
      </Container>
    </ThemeProvider>
  );
};

export default App;
