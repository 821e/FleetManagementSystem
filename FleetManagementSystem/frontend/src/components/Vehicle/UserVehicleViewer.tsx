import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Box, Heading, Text, VStack, Image, SimpleGrid, Select } from '@chakra-ui/react';
import styled from '@emotion/styled';

const Container = styled.div`
  background: #ffffff;
  color: #000000;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 1000px;
  margin: 0 auto;
`;

const Title = styled(Heading)`
  background: linear-gradient(to right, #000000 0%, #dc143c 51%, #000000 100%);
  padding: 15px 45px;
  text-align: center;
  text-transform: uppercase;
  transition: 0.5s;
  background-size: 200% auto;
  color: white;
  box-shadow: 0 0 20px #eee;
  border-radius: 10px;
  display: block;
  border: 0px;
  margin-bottom: 20px;
  &:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
  }
`;

interface Vehicle {
  id: number;
  make: string;
  model: string;
  year: number;
  status: string;
  assigned_to: number;
  image_path: string;
  description: string;
}

const UserVehicleViewer: React.FC = () => {
  const [vehicles, setVehicles] = useState<Vehicle[]>([]);
  const [selectedVehicle, setSelectedVehicle] = useState<Vehicle | null>(null);

  useEffect(() => {
    fetchVehicles();
  }, []);

  const fetchVehicles = async () => {
    try {
      const response = await axios.get('/vehicles');
      setVehicles(response.data);
    } catch (error) {
      console.error('Error fetching vehicles:', error);
    }
  };

  const handleSelectChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const vehicleId = Number(e.target.value);
    const vehicle = vehicles.find((v) => v.id === vehicleId) || null;
    setSelectedVehicle(vehicle);
  };

  return (
    <Container>
      <Title>Vehicle Viewer</Title>
      <VStack spacing={4}>
        <Select placeholder="Select Vehicle" onChange={handleSelectChange}>
          {vehicles.map((vehicle) => (
            <option key={vehicle.id} value={vehicle.id}>
              {vehicle.make} {vehicle.model} ({vehicle.year})
            </option>
          ))}
        </Select>
        {selectedVehicle && (
          <Box p={4} borderWidth="1px" borderRadius="lg" boxShadow="md" w="100%">
            <SimpleGrid columns={{ base: 1, md: 2 }} spacing={10}>
              {selectedVehicle.image_path && (
                <Image
                  src={selectedVehicle.image_path}
                  alt={`${selectedVehicle.make} ${selectedVehicle.model}`}
                  borderRadius="lg"
                  maxH="300px"
                  objectFit="cover"
                />
              )}
              <VStack align="start" spacing={2}>
                <Heading size="md">{selectedVehicle.make} {selectedVehicle.model} ({selectedVehicle.year})</Heading>
                <Text><strong>Status:</strong> {selectedVehicle.status}</Text>
                <Text><strong>Assigned To:</strong> {selectedVehicle.assigned_to}</Text>
                <Text><strong>Description:</strong> {selectedVehicle.description}</Text>
              </VStack>
            </SimpleGrid>
          </Box>
        )}
      </VStack>
    </Container>
  );
};

export default UserVehicleViewer;
