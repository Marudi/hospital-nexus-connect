
import React from 'react';

interface PatientCardProps {
  name: string;
  age: number;
  gender: string;
  lastVisit: string;
  condition: string;
}

const PatientCard = ({ name, age, gender, lastVisit, condition }: PatientCardProps) => {
  return (
    <div className="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
      <h3 className="font-semibold text-lg text-gray-900">{name}</h3>
      <div className="mt-2 space-y-2">
        <p className="text-sm text-gray-600">
          <span className="font-medium">Age:</span> {age}
        </p>
        <p className="text-sm text-gray-600">
          <span className="font-medium">Gender:</span> {gender}
        </p>
        <p className="text-sm text-gray-600">
          <span className="font-medium">Last Visit:</span> {lastVisit}
        </p>
        <p className="text-sm text-gray-600">
          <span className="font-medium">Condition:</span>{' '}
          <span className="px-2 py-1 rounded-full text-xs bg-purple-100 text-purple-700">
            {condition}
          </span>
        </p>
      </div>
    </div>
  );
};

export default PatientCard;
