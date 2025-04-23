
import React from 'react';
import { Calendar, Clock } from 'lucide-react';

const mockAppointments = [
  {
    id: 1,
    patientName: "John Doe",
    date: "2025-04-24",
    time: "09:00 AM",
    type: "Check-up",
    status: "Scheduled"
  },
  {
    id: 2,
    patientName: "Jane Smith",
    date: "2025-04-24",
    time: "10:30 AM",
    type: "Follow-up",
    status: "Confirmed"
  },
  {
    id: 3,
    patientName: "Robert Johnson",
    date: "2025-04-24",
    time: "02:00 PM",
    type: "Consultation",
    status: "Pending"
  }
];

const AppointmentList = () => {
  return (
    <div className="bg-white rounded-lg shadow">
      <div className="grid grid-cols-6 gap-4 p-4 border-b bg-gray-50 font-semibold">
        <div>Patient</div>
        <div>Date</div>
        <div>Time</div>
        <div>Type</div>
        <div>Status</div>
        <div>Actions</div>
      </div>
      <div className="divide-y">
        {mockAppointments.map((appointment) => (
          <div key={appointment.id} className="grid grid-cols-6 gap-4 p-4 items-center hover:bg-gray-50">
            <div>{appointment.patientName}</div>
            <div className="flex items-center gap-2">
              <Calendar className="h-4 w-4" />
              {appointment.date}
            </div>
            <div className="flex items-center gap-2">
              <Clock className="h-4 w-4" />
              {appointment.time}
            </div>
            <div>{appointment.type}</div>
            <div>
              <span className={`px-2 py-1 rounded-full text-sm ${
                appointment.status === 'Confirmed' ? 'bg-green-100 text-green-800' :
                appointment.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                'bg-blue-100 text-blue-800'
              }`}>
                {appointment.status}
              </span>
            </div>
            <div className="flex gap-2">
              <button className="text-blue-600 hover:text-blue-800">Edit</button>
              <button className="text-red-600 hover:text-red-800">Cancel</button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default AppointmentList;
