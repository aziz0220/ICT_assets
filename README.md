# **ICT Asset Management System (iAMS)**  

### **Overview**  
The **ICT Asset Management System (iAMS)** is a robust solution developed for the **Open University of Tanzania (OUT)** to manage ICT assets efficiently. Designed with user-centric UI/UX principles, iAMS combines modern web technologies with intuitive design to streamline asset tracking, maintenance scheduling, compliance reporting, and lifecycle management.  

This project was built during my summer internship to provide OUT with a scalable, responsive, and accessible tool tailored to the institution's needs, aligning with its mission of adopting modern technology to enhance efficiency.  


<p align="center">
  <img src="public/img.png" width="600" alt="Landing Page">
</p>



---

### **Features**  
- **Minimalist and Ergonomic Interfaces**: Optimized for seamless user interaction, focusing on usability and accessibility.  
- **Role-Based Access Control (RBAC)**: Features tailored to user roles, including Admin, Staff, Asset Manager, and Executive Management.  
- **Centralized Asset Register**: Comprehensive asset tracking with classification and categorization.  
- **CRUD Operations**: Accessible directly from dynamic tables and bulk action functionalities for efficient multitasking.  
- **Automated Notifications**: Maintenance reminders and issue resolution updates to reduce downtime.  
- **Custom Reports**: Generate insightful reports for compliance and decision-making.  
- **Audit Trails**: Comprehensive logs for tracking system activities.  


  <img src="public/img1.png" width="300" alt="Admin Dashboard">
  <img src="public/img2.png" width="300" alt="Manage Users">
  <img src="public/img3.png" width="300" alt="Show User">
  <img src="public/img4.png" width="300" alt="Edit User">




---

### **Technical Highlights**  
#### **Frontend**  
- **Responsive Design**: Built using **TailwindCSS**, adhering to WCAG guidelines for accessibility.  
- **Interactive UI**: Leveraged **HTMX** for partial page updates, reducing page reloads and enhancing responsiveness.  
- **Dynamic Tables**: Integrated search and bulk action features, offering a seamless user experience.  

#### **Backend**  
- **Framework**: Built with **Laravel** (v11.14.0) using the MVC architecture for maintainability.  
- **Database**: Powered by **PostgreSQL** for robust and scalable data handling.  
- **Notifications**: Implemented using Laravel's notification system for timely updates.  

#### **Version Control & Collaboration**  
- **GitLab**: Used for version control, issue tracking, and team collaboration.  

#### **Deployment Environment**  
- **Operating System**: Ubuntu 22.04  
- **Web Server**: Apache  
- **Containerization**: Docker (for deployment optimization).  

---

### **Installation**  
Follow these steps to set up the project locally:  

1. **Clone the repository**  
   ```bash  
   git clone https://git.out.ac.tz/isda/ict_register.git  
   ```  

2. **Navigate to the project directory**  
   ```bash  
   cd ict-asset-register  
   ```  

3. **Install dependencies**  
   ```bash  
   composer install  
   npm install  
   ```  

4. **Copy the environment file and configure variables**  
   ```bash  
   cp .env.example .env  
   ```  

5. **Generate application key**  
   ```bash  
   php artisan key:generate  
   ```  

6. **Run migrations and seed the database**  
   ```bash  
   php artisan migrate --seed  
   ```  

7. **Start the development server**  
   ```bash  
   php artisan serve  
   ```  

---

### **Usage**  
After completing the installation, access the application at:  
`http://localhost:8000`  

Log in with predefined roles to explore the system functionalities tailored to each user type.  

---

### **Project Workflow**  
The project followed the **Kanban methodology** to ensure a streamlined and iterative development process. Task management was visualized using GitLab boards, allowing efficient progress tracking and collaboration.  

---

### **Future Enhancements**  
- **Mobile Application**: Extend accessibility to mobile devices.  
- **Advanced Analytics**: Introduce AI-driven insights for better decision-making.  
- **Integration with External Systems**: Enhance compatibility with other university tools.  

---

### **Contact**  
For queries or feedback about this project:  
**Aziz Amor**  
- Email: [aziz.amor@student.out.ac.tz](mailto:aziz.amor@student.out.ac.tz)  

---

### **Acknowledgments**  
This project was developed during my internship at **The Open University of Tanzania**, aligning with the institution’s strategic goals for modernizing internal processes. It adheres to the **e-Government Guidelines (March 2020)** provided by e-GA.  

---

### **Resources**  
- **Presentation**: [Canva Presentation](https://www.canva.com/design/DAGWfiAq5Uc/6SEb4hZwWjwuhRW2PDPoNg/edit?utm_content=DAGWfiAq5Uc&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)  
- **Report PDF**: [Internship Report](https://drive.google.com/file/d/1PmD9XfTMxuf9FgKI0wmyuu1cS0gIxOkn/view?usp=sharing)  

---

