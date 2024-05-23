import React, { useState } from 'react';
import styled, { keyframes } from 'styled-components';

// --- Color Palette ---
const colors = {
    primary: '#CCD5AE',
    background: '#E9EDC9',
    highlight: '#FEFAE0',
    secondary: '#FAEDCD',
    accent: '#D4A373'
};

// --- Keyframe Animations ---
const float = keyframes`
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
`;

// --- Styled Components ---

const Container = styled.div`
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: radial-gradient(circle at center, ${colors.background} 50%, ${colors.primary});
`;

const Card = styled.div`
    background-color: ${colors.background};
    padding: 50px; /* Increased padding for more breathing room */
    border-radius: 25px; /* Slightly rounder corners */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow */
    width: 450px;
    text-align: center;
    animation: ${float} 4s ease-in-out infinite; /* Gentle floating animation */
`;

const Title = styled.h1`
    color: ${colors.accent};
    margin-bottom: 40px; /* Increased margin */
    font-size: 3em;  /* Larger title */
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
`;

const Input = styled.input`
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border: 1px solid ${colors.primary};
    border-radius: 8px;
    background-color: ${colors.highlight};
    color: ${colors.accent};
    &:focus {
        outline: none;
        border-color: ${colors.accent};
    }
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

const Button = styled.button`
    background-color: ${colors.accent};
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
        background-color: darken(${colors.accent}, 10%);
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
        background: linear-gradient(90deg, ${colors.primary} 0%, ${colors.secondary} 100%); /* Gradient mask */
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
    color: ${colors.accent};
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
        color: ${colors.accent};
        text-decoration: underline;
        cursor: pointer;
        font-size: 1em;
        transition: color 0.3s ease;

        &:hover {
            color: ${colors.secondary};
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
    );
};

export default App;