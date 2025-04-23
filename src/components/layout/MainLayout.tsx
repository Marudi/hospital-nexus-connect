
import React from 'react';
import { Sidebar, SidebarContent, SidebarGroup, SidebarGroupContent, SidebarGroupLabel, SidebarMenu, SidebarMenuItem, SidebarMenuButton } from "@/components/ui/sidebar";
import { SidebarProvider, SidebarTrigger } from "@/components/ui/sidebar";
import { Home, UserSquare2, ClipboardList, Calendar } from 'lucide-react';

const MainLayout = ({ children }: { children: React.ReactNode }) => {
  const menuItems = [
    { title: 'Dashboard', icon: Home, path: '/' },
    { title: 'Patients', icon: UserSquare2, path: '/patients' },
    { title: 'Appointments', icon: Calendar, path: '/appointments' },
    { title: 'Medical Records', icon: ClipboardList, path: '/records' },
  ];

  return (
    <SidebarProvider>
      <div className="min-h-screen flex w-full">
        <Sidebar>
          <SidebarContent>
            <SidebarGroup>
              <SidebarGroupLabel>Hospital Management</SidebarGroupLabel>
              <SidebarGroupContent>
                <SidebarMenu>
                  {menuItems.map((item) => (
                    <SidebarMenuItem key={item.title}>
                      <SidebarMenuButton asChild>
                        <a href={item.path}>
                          <item.icon />
                          <span>{item.title}</span>
                        </a>
                      </SidebarMenuButton>
                    </SidebarMenuItem>
                  ))}
                </SidebarMenu>
              </SidebarGroupContent>
            </SidebarGroup>
          </SidebarContent>
        </Sidebar>
        <main className="flex-1 p-6">
          <SidebarTrigger className="mb-4" />
          {children}
        </main>
      </div>
    </SidebarProvider>
  );
};

export default MainLayout;
