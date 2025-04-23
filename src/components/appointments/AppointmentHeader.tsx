
import React from 'react';

const AppointmentHeader = () => {
  return (
    <div className="flex justify-between items-center">
      <h1 className="text-2xl font-bold text-gray-900">Appointments</h1>
      <button className="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
        New Appointment
      </button>
    </div>
  );
};

export default AppointmentHeader;
