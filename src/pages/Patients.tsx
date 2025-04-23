
import React from 'react';
import PatientCard from '../components/PatientCard';

// Mock data for demonstration
const mockPatients = [
  {
    id: 1,
    name: "John Doe",
    age: 45,
    gender: "Male",
    lastVisit: "2025-04-20",
    condition: "Routine Checkup"
  },
  {
    id: 2,
    name: "Jane Smith",
    age: 32,
    gender: "Female",
    lastVisit: "2025-04-21",
    condition: "Follow-up"
  },
  {
    id: 3,
    name: "Mike Johnson",
    age: 28,
    gender: "Male",
    lastVisit: "2025-04-22",
    condition: "Treatment"
  },
  {
    id: 4,
    name: "Sarah Wilson",
    age: 52,
    gender: "Female",
    lastVisit: "2025-04-23",
    condition: "Consultation"
  }
];

const Patients = () => {
  return (
    <div className="p-6">
      <div className="flex justify-between items-center mb-6">
        <h1 className="text-2xl font-bold">Patients</h1>
        <button className="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
          Add New Patient
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {mockPatients.map((patient) => (
          <PatientCard
            key={patient.id}
            name={patient.name}
            age={patient.age}
            gender={patient.gender}
            lastVisit={patient.lastVisit}
            condition={patient.condition}
          />
        ))}
      </div>
    </div>
  );
};

export default Patients;
