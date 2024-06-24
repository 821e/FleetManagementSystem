import React, { useState, useContext } from 'react';
import { useNavigate } from 'react-router-dom';
import styled, { ThemeProvider, createGlobalStyle } from 'styled-components';
import { ChakraProvider, Box, Tabs, TabList, Tab, TabPanels, TabPanel, Button, Input, Heading, VStack, Text } from '@chakra-ui/react';
import { AuthContext } from '../App';

// --- Color Palette ---
const colors = {
  primary: '#000000',
  background: '#FFFFFF',
  accent: '#DC143C',
};

// --- Global Styles ---
const GlobalStyle = createGlobalStyle`
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
    background: ${colors.background};
    color: ${colors.primary};
    font-family: 'Roboto', sans-serif;
  }
`;

// --- Styled Components ---
const Container = styled.div`
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
`;

const Card = styled(Box)`
  background-color: ${colors.background};
  padding: 50px;
  border-radius: 25px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 450px;
  text-align: center;
`;

const Title = styled(Heading)`
  color: ${colors.primary};
  margin-bottom: 20px;
  font-size: 2em;
`;

const ErrorMessage = styled(Text)`
  color: red;
  margin-top: 10px;
`;

const Login: React.FC = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [tabIndex, setTabIndex] = useState(0);
  const [error, setError] = useState<string>('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const context = useContext(AuthContext);

  if (!context) {
    throw new Error('AuthContext is not available');
  }

  const { setAuth } = context;

  const handleSubmit = async () => {
    setLoading(true);
    setError('');

    const url = 'http://localhost:8080/auth/login';
    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
      });

      if (!response.ok) {
        throw new Error('Login failed');
      }

      const data = await response.json();
      console.log(data);

      // Set authentication context and navigate based on user role
      setAuth({ isLoggedIn: true, role: data.role });

      if (data.role === 'admin') {
        navigate('/admin/dashboard');
      } else if (data.role === 'user') {
        navigate('/user/dashboard');
      } else {
        throw new Error('Unknown user role');
      }
    } catch (err: any) {
      setError(err.message);
      console.error('Error:', err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <ChakraProvider>
      <ThemeProvider theme={colors}>
        <GlobalStyle />
        <Container>
          <Card>
            <Title>Fleet Management System</Title>
            <Tabs variant="enclosed" index={tabIndex} onChange={(index) => setTabIndex(index)}>
              <TabList>
                <Tab>User Login</Tab>
                <Tab>Admin Login</Tab>
              </TabList>
              <TabPanels>
                <TabPanel>
                  <VStack spacing={4}>
                    <Input
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
                    <Button colorScheme="red" isLoading={loading} onClick={handleSubmit}>
                      {loading ? 'Loading...' : 'Login'}
                    </Button>
                    {error && <ErrorMessage>{error}</ErrorMessage>}
                  </VStack>
                </TabPanel>
                <TabPanel>
                  <VStack spacing={4}>
                    <Input
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
                    <Button colorScheme="red" isLoading={loading} onClick={handleSubmit}>
                      {loading ? 'Loading...' : 'Login'}
                    </Button>
                    {error && <ErrorMessage>{error}</ErrorMessage>}
                  </VStack>
                </TabPanel>
              </TabPanels>
            </Tabs>
          </Card>
        </Container>
      </ThemeProvider>
    </ChakraProvider>
  );
};

export default Login;
