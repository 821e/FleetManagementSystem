import { extendTheme } from '@chakra-ui/react';

const breakpoints = {
  sm: '30em',
  md: '48em',
  lg: '62em',
  xl: '80em',
};

const theme = extendTheme({
  breakpoints,
  // Add other theme configurations here
});

export default theme;
