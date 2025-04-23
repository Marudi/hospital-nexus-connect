
import React from 'react';

const Dashboard = () => {
  return (
    <div>
      <h1 className="text-2xl font-bold mb-6">Hospital Dashboard</h1>
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div className="p-6 bg-white rounded-lg shadow">
          <h2 className="text-lg font-semibold mb-2">Total Patients</h2>
          <p className="text-3xl font-bold">0</p>
        </div>
        <div className="p-6 bg-white rounded-lg shadow">
          <h2 className="text-lg font-semibold mb-2">Today's Appointments</h2>
          <p className="text-3xl font-bold">0</p>
        </div>
        <div className="p-6 bg-white rounded-lg shadow">
          <h2 className="text-lg font-semibold mb-2">Available Doctors</h2>
          <p className="text-3xl font-bold">0</p>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
