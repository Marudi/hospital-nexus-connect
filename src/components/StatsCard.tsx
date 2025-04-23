
import React from 'react';
import { LucideIcon } from 'lucide-react';

interface StatsCardProps {
  title: string;
  value: string | number;
  icon: LucideIcon;
  description?: string;
}

const StatsCard = ({ title, value, icon: Icon, description }: StatsCardProps) => {
  return (
    <div className="bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
      <div className="flex items-center justify-between">
        <div>
          <p className="text-gray-600 text-sm font-medium">{title}</p>
          <h3 className="text-2xl font-bold mt-1">{value}</h3>
          {description && (
            <p className="text-gray-500 text-sm mt-1">{description}</p>
          )}
        </div>
        <div className="bg-purple-100 p-3 rounded-full">
          <Icon className="w-6 h-6 text-purple-600" />
        </div>
      </div>
    </div>
  );
};

export default StatsCard;
