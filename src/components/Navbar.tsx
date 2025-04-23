
import { Link } from 'react-router-dom';

const Navbar = () => {
  return (
    <nav className="bg-white shadow-lg">
      <div className="max-w-7xl mx-auto px-4">
        <div className="flex justify-between h-16">
          <div className="flex">
            <div className="flex-shrink-0 flex items-center">
              <Link to="/" className="text-xl font-bold text-purple-600">
                Hospital Manager
              </Link>
            </div>
            <div className="hidden sm:ml-6 sm:flex sm:space-x-8">
              <Link
                to="/"
                className="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-purple-600"
              >
                Home
              </Link>
              <Link
                to="/patients"
                className="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-purple-600"
              >
                Patients
              </Link>
              <Link
                to="/appointments"
                className="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-purple-600"
              >
                Appointments
              </Link>
            </div>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
