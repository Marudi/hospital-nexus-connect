
import React from 'react';
import AppointmentList from '../components/appointments/AppointmentList';
import AppointmentHeader from '../components/appointments/AppointmentHeader';

const Appointments = () => {
  return (
    <div className="container mx-auto p-4 space-y-6">
      <AppointmentHeader />
      <AppointmentList />
    </div>
  );
};

export default Appointments;
