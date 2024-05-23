export {}
// Represents the admin dashboard page.
// Commenting out the entire return statement to hide the page.
// const AdminDashboard = () => {
//     const [activeSection, setActiveSection] = useState('overview');

//     return (
//         <DashboardContainer>
//             <Sidebar>
//                 <SidebarLink href="#" onClick={() => setActiveSection('overview')} active={activeSection === 'overview'}>Overview</SidebarLink>
//                 <SidebarLink href="#" onClick={() => setActiveSection('drivers')} active={activeSection === 'drivers'}>Driver Management</SidebarLink>
//                 <SidebarLink href="#" onClick={() => setActiveSection('vehicles')} active={activeSection === 'vehicles'}>Vehicle Management</SidebarLink>
//                 <SidebarLink href="#" onClick={() => setActiveSection('bookings')} active={activeSection === 'bookings'}>Booking Management</SidebarLink>
//                 <SidebarLink href="#" onClick={() => setActiveSection('tracking')} active={activeSection === 'tracking'}>Real-Time Tracking</SidebarLink>
//                 {/* ... add more sidebar links for other sections */}
//             </Sidebar>
//             <MainContent>
//                 {activeSection === 'overview' && <OverviewSection />}
//                 {activeSection === 'drivers' && <DriverManagementSection />}
//                 {activeSection === 'vehicles' && <VehicleManagementSection />}
//                 {activeSection === 'bookings' && <BookingManagementSection />}
//                 {activeSection === 'tracking' && <RealTimeTrackingSection />}
//                 {/* ... render other sections based on activeSection */}
//             </MainContent>
//         </DashboardContainer>
//     );
// };

// export default AdminDashboard;
