import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Tabs, TabList, TabPanels, Tab, TabPanel, Box, Input, Textarea, Button, Select, Heading, VStack } from '@chakra-ui/react';
import styled from '@emotion/styled';

const Container = styled.div`
  background: #ffffff;
  color: #000000;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 800px;
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
}

const AdminVehicleManager: React.FC = () => {
  const [vehicles, setVehicles] = useState<Vehicle[]>([]);
  const [newVehicle, setNewVehicle] = useState<Partial<Vehicle>>({});
  const [selectedVehicleId, setSelectedVehicleId] = useState<number | null>(null);
  const [image, setImage] = useState<File | null>(null);

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

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setNewVehicle((prev) => ({ ...prev, [name]: value }));
  };

  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
      setImage(e.target.files[0]);
    }
  };

  const handleAddVehicle = async () => {
    const formData = new FormData();
    Object.entries(newVehicle).forEach(([key, value]) => {
      formData.append(key, value as string | Blob);
    });
    if (image) {
      formData.append('image', image);
    }

    try {
      await axios.post('/vehicles', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      fetchVehicles();
      setNewVehicle({});
      setImage(null);
    } catch (error) {
      console.error('Error adding vehicle:', error);
    }
  };

  const handleDeleteVehicle = async () => {
    if (selectedVehicleId !== null) {
      try {
        await axios.delete(`/vehicles/${selectedVehicleId}`);
        fetchVehicles();
        setSelectedVehicleId(null);
      } catch (error) {
        console.error('Error deleting vehicle:', error);
      }
    }
  };

  const handleEditVehicle = async () => {
    if (selectedVehicleId !== null) {
      const formData = new FormData();
      Object.entries(newVehicle).forEach(([key, value]) => {
        formData.append(key, value as string | Blob);
      });
      if (image) {
        formData.append('image', image);
      }

      try {
        await axios.put(`/vehicles/${selectedVehicleId}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        fetchVehicles();
        setNewVehicle({});
        setImage(null);
        setSelectedVehicleId(null);
      } catch (error) {
        console.error('Error editing vehicle:', error);
      }
    }
  };

  return (
    <Container>
      <Title>New Vehicle Form</Title>
      <Tabs isFitted variant="enclosed">
        <TabList mb="1em">
          <Tab>Add Vehicle</Tab>
          <Tab>Edit Vehicle</Tab>
          <Tab>Delete Vehicle</Tab>
        </TabList>
        <TabPanels>
          <TabPanel>
            <VStack spacing={4}>
              <Input placeholder="Make" name="make" value={newVehicle.make || ''} onChange={handleInputChange} />
              <Input placeholder="Model" name="model" value={newVehicle.model || ''} onChange={handleInputChange} />
              <Input type="number" placeholder="Year" name="year" value={newVehicle.year || ''} onChange={handleInputChange} />
              <Select placeholder="Status" name="status" value={newVehicle.status || ''} onChange={handleInputChange}>
                <option value="Available">Available</option>
                <option value="In Use">In Use</option>
                <option value="Under Maintenance">Under Maintenance</option>
                <option value="Decommissioned">Decommissioned</option>
              </Select>
              <Input type="number" placeholder="Assigned To" name="assigned_to" value={newVehicle.assigned_to || ''} onChange={handleInputChange} />
              <Input type="file" name="image" onChange={handleImageChange} />
              <Button colorScheme="red" onClick={handleAddVehicle}>Add Vehicle</Button>
            </VStack>
          </TabPanel>
          <TabPanel>
            <VStack spacing={4}>
              <Select placeholder="Select Vehicle" onChange={(e) => setSelectedVehicleId(Number(e.target.value))}>
                {vehicles.map((vehicle) => (
                  <option key={vehicle.id} value={vehicle.id}>
                    {vehicle.make} {vehicle.model} ({vehicle.year})
                  </option>
                ))}
              </Select>
              <Input placeholder="Make" name="make" value={newVehicle.make || ''} onChange={handleInputChange} />
              <Input placeholder="Model" name="model" value={newVehicle.model || ''} onChange={handleInputChange} />
              <Input type="number" placeholder="Year" name="year" value={newVehicle.year || ''} onChange={handleInputChange} />
              <Select placeholder="Status" name="status" value={newVehicle.status || ''} onChange={handleInputChange}>
                <option value="Available">Available</option>
                <option value="In Use">In Use</option>
                <option value="Under Maintenance">Under Maintenance</option>
                <option value="Decommissioned">Decommissioned</option>
              </Select>
              <Input type="number" placeholder="Assigned To" name="assigned_to" value={newVehicle.assigned_to || ''} onChange={handleInputChange} />
              <Input type="file" name="image" onChange={handleImageChange} />
              <Button colorScheme="red" onClick={handleEditVehicle}>Edit Vehicle</Button>
            </VStack>
          </TabPanel>
          <TabPanel>
            <VStack spacing={4}>
              <Select placeholder="Select Vehicle" onChange={(e) => setSelectedVehicleId(Number(e.target.value))}>
                {vehicles.map((vehicle) => (
                  <option key={vehicle.id} value={vehicle.id}>
                    {vehicle.make} {vehicle.model} ({vehicle.year})
                  </option>
                ))}
              </Select>
              <Button colorScheme="red" onClick={handleDeleteVehicle}>Delete Vehicle</Button>
            </VStack>
          </TabPanel>
        </TabPanels>
      </Tabs>
    </Container>
  );
};

export default AdminVehicleManager;
