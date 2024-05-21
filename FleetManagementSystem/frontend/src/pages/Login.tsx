import React from 'react';
import Login from '@react-login-page/page10';
import LoginImg from '../assets/forest.jpg';
import LoginInnerBgImg from '@react-login-page/page10/inner-bg.jpg';

const Demo = () => (
  <Login style={{ height: 690, backgroundImage: `url(${LoginImg})` }}>
    <Login.InnerBox style={{ backgroundImage: `url(${LoginInnerBgImg})` }} />
    <Login.InnerBox panel="signup" style={{ backgroundImage: `url(${LoginInnerBgImg})` }} />
  </Login>
);

export default Demo;