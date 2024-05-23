import React, { useState } from 'react';
import styled, { css } from 'styled-components';
import LoginPage, {
    Username, Password, Submit, Title, Logo
} from '@react-login-page/page1';
import LoginLogo from 'react-login-page/logo';

// Styled Components
const Container = styled.div`
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100vw;
    background: linear-gradient(135deg, #f5515f, #6441a5);
    overflow: hidden; /* Ensure no white space on stretching */
`;

const StyledLoginPage = styled(LoginPage)`
    background-color: rgba(255, 255, 255, 0.15); 
    padding: 40px;
    border-radius: 20px;
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 

    @media (max-width: 768px) {
        width: 90%; 
    }
`;

const StyledLogo = styled(Logo)`
    margin-bottom: 30px; 
`;

// Input Field Styling
const InputField = css`
    background-color: rgba(255, 255, 255, 0.3); 
    border: none;
    border-radius: 10px; 
    padding: 15px; 
    margin: 12px 0; 
    width: 100%;
    font-size: 16px; 
    color: #333; 
`;

const StyledUsername = styled(Username)`${InputField}`;
const StyledPassword = styled(Password)`${InputField}`;

// Button Styling
const SubmitButton = styled(Submit)`
    background-color: #6441a5; 
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 18px; 
    transition: background-color 0.3s ease;

    &:hover {
        background-color: #503690;
    }
`;

// Shared Button Style (for both links)
const buttonStyle = css`
    margin-top: 15px;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px; 
    transition: background-color 0.3s ease, transform 0.2s ease; 

    &:hover {
        transform: translateY(-2px); 
    }
`;

const AdminLink = styled.a`
    ${buttonStyle}
    color: #fff;
    background-color: #a855f7; 
    text-decoration: none;
`;

const UserLink = styled.a`
    ${buttonStyle}
    color: #a855f7;  
    background-color: transparent;
    border: 2px solid #a855f7; 
    text-decoration: none;
`;

const Demo = () => {
    const [isAdminLogin, setIsAdminLogin] = useState(false);

    const handleAdminClick = () => setIsAdminLogin(true);
    const handleUserClick = () => setIsAdminLogin(false);

    return (
        <Container> 
            <StyledLoginPage>
                <StyledLogo>
                    <LoginLogo />
                </StyledLogo>
                <Title />
                {isAdminLogin ? (
                    <>
                        <StyledUsername name="adminUserName" />
                        <StyledPassword placeholder="Password" name="adminPassword" />
                        <SubmitButton>Admin Submit</SubmitButton>
                        <UserLink onClick={handleUserClick}>Login as User</UserLink>
                    </>
                ) : (
                    <>
                        <StyledUsername name="userUserName" />
                        <StyledPassword placeholder="Password" name="userPassword" />
                        <SubmitButton>Submit</SubmitButton>
                        <AdminLink onClick={handleAdminClick}>Login as Admin</AdminLink>
                    </>
                )}
            </StyledLoginPage>
        </Container>
    );
};

export default Demo;
