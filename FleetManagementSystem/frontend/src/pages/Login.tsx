import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import styled, { keyframes, ThemeProvider, createGlobalStyle } from 'styled-components';
import backSVG from '../assets/back.svg';

// --- Color Palette ---
const colors = {
  primary: '#4D6A79',       // Dark blue from the truck
  backgroundLight: '#F0F4F5', // Very light grey
  background: '#E5E9EB',    // Slightly darker grey
  highlight: '#7390A2',     // Medium blue
  secondary: '#637B8C',     // Medium-dark blue
  accent: '#A3B0B9',        // Light blue-grey
};

// --- Global Styles ---
const GlobalStyle = createGlobalStyle`
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
    background-image: url(${backSVG});
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    overflow-x: hidden;
  }
`;

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
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(255, 255, 255, 0.8); /* Slight white overlay for readability */
`;

const Card = styled.div`
  background-color: ${props => props.theme.background};
  padding: 50px;
  border-radius: 25px;
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
  width: 450px;
  text-align: center;
  animation: ${float} 4s ease-in-out infinite;
`;

const Title = styled.h1`
  color: ${props => props.theme.primary};
  margin-bottom: 40px;
  font-size: 2.5em;
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
  font-weight: bold;
  transition: background-color 0.3s ease, transform 0.2s ease;

  &:hover {
    transform: translateY(-2px);
    background-color: ${props => darken(props.theme.accent, 10)};
  }

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
    background: linear-gradient(90deg, ${props => props.theme.primary} 0%, ${props => props.theme.secondary} 100%);
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    z-index: -1;
  }

  &:hover::before {
    transform: translateX(0);
    animation: ${maskAnimation} 0.8s steps(20) 1 forwards;
  }
`;

const AdminCard = styled(Card)`
  width: 500px;
`;

const RoleToggle = styled.button`
  background: none;
  border: none;
  color: ${props => props.theme.accent};
  text-decoration: underline;
  cursor: pointer;
  font-size: 0.9em;
  margin-top: 10px;
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
  const [adminCode, setAdminCode] = useState('');
  const [isAdminView, setIsAdminView] = useState(false);

  const navigate = useNavigate();

  const handleSubmit = (role: 'user' | 'admin') => {
    const url = role === 'admin' ? '/auth/admin/login' : '/auth/login';
    fetch(`http://localhost:8080${url}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            admin_code: role === 'admin' ? adminCode : undefined,
            username: username,
            password: password
        })
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Login failed');
    })
    .then(data => {
        console.log(data);
        navigate('/');
    })
    .catch(error => {
        console.error('Error:', error);
    });
  };

  return (
    <ThemeProvider theme={colors}>
      <GlobalStyle />
      <Container>
        {isAdminView ? (
          <AdminCard>
            <Title>Admin Login</Title>
            <Input 
              type="text" 
              placeholder="Admin Code" 
              value={adminCode} 
              onChange={(e) => setAdminCode(e.target.value)} 
            />
            <Input 
              type="text" 
              placeholder="Username" 
              value={username} 
              onChange={(e) => setUsername(e.target.value)} 
            />
            <Input 
              type="password" 
              placeholder="Password" 
              value={password} 
              onChange={(e) => setPassword(e.target.value)} 
            />
            <Button onClick={() => handleSubmit('admin')}>Login as Admin</Button>
            <RoleToggleContainer>  
              <RoleToggle onClick={() => setIsAdminView(false)}>Login as User</RoleToggle>
            </RoleToggleContainer>
          </AdminCard>
        ) : (
          <Card>
            <Title>Fleet Management System</Title>
            <Input 
              type="text" 
              placeholder="Username" 
              value={username} 
              onChange={(e) => setUsername(e.target.value)} 
            />
            <Input 
              type="password" 
              placeholder="Password" 
              value={password} 
              onChange={(e) => setPassword(e.target.value)} 
            />
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
