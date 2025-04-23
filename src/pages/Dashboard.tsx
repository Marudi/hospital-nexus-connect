
import React from 'react';
import { Users, Calendar, FileText } from 'lucide-react';
import StatsCard from '../components/StatsCard';
import SimpleBarChart from '../components/SimpleBarChart';

const mockChartData = [
  { name: 'Mon', value: 12 },
  { name: 'Tue', value: 19 },
  { name: 'Wed', value: 15 },
  { name: 'Thu', value: 22 },
  { name: 'Fri', value: 18 },
  { name: 'Sat', value: 10 },
  { name: 'Sun', value: 8 },
];

const Dashboard = () => {
  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold mb-6">Dashboard</h1>
      
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <StatsCard
          title="Total Patients"
          value="1,234"
          icon={Users}
          description="124 new this month"
        />
        <StatsCard
          title="Appointments Today"
          value="48"
          icon={Calendar}
          description="6 pending confirmation"
        />
        <StatsCard
          title="Medical Records"
          value="892"
          icon={FileText}
          description="Updated today"
        />
      </div>

      <div className="mt-8">
        <SimpleBarChart
          data={mockChartData}
          title="Weekly Patient Visits"
        />
      </div>
    </div>
  );
};

export default Dashboard;
