# Applicy

Applicy is a comprehensive online platform that simplifies your job application process. Create a personalized profile to seamlessly track all your job applications and monitor their progress in real time. With Applicy, you can easily organize your job search efforts, making it simpler to stay on top of your applications and secure your next opportunity.

<div>
	<img width="50" src="https://user-images.githubusercontent.com/25181517/183570228-6a040b9f-3ddf-47a2-a201-743121dac664.png" alt="php" title="php"/>
	<img width="50" src="https://github.com/marwin1991/profile-technology-icons/assets/25181517/afcf1c98-544e-41fb-bf44-edba5e62809a" alt="Laravel" title="Laravel"/>
	<img width="50" src="https://user-images.githubusercontent.com/25181517/183896128-ec99105a-ec1a-4d85-b08b-1aa1620b2046.png" alt="MySQL" title="MySQL"/>
	<img width="50" src="https://user-images.githubusercontent.com/25181517/117447155-6a868a00-af3d-11eb-9cfe-245df15c9f3f.png" alt="JavaScript" title="JavaScript"/>
	<img width="50" src="https://user-images.githubusercontent.com/25181517/117448124-a2da9800-af3e-11eb-85d2-bd1b69b65603.png" alt="Vue.js" title="Vue.js"/>
	<img width="50" src="https://user-images.githubusercontent.com/25181517/202896760-337261ed-ee92-4979-84c4-d4b829c7355d.png" alt="Tailwind CSS" title="Tailwind CSS"/>
	<img width="50" src="https://user-images.githubusercontent.com/25181517/117207330-263ba280-adf4-11eb-9b97-0ac5b40bc3be.png" alt="Docker" title="Docker"/>
</div>

## Getting Started

### Prerequisites

Ensure you have the following prerequisites installed on your system. You can verify each installation by running the provided commands in your terminal.

1. **PHP** is required for the application. Check if PHP is installed by running:

   ```bash
   php --version
   ```

2. **Composer** is necessary for managing PHP dependencies. Verify its installation with:

   ```bash
   composer --version
   ```

3. **Docker** is used for containerization. Confirm Docker is installed by running:

   ```bash
   docker --version
   ```

4. **Node** and **NPM** (Node Package Manager) are needed for managing frontend dependencies. Check their installations with:

   ```bash
   node --version
   npm --version
   ```

### Installation

1. Duplicate the example environment file and configure it with your settings:

   ```bash
   cp .env.example .env
   ```

2. Install PHP and JavaScript dependencies:

   ```bash
   composer install
   npm install
   ```

3. Generate a new PHP application key:

   ```bash
   php artisan key:generate
   ```

4. Use Sail to build and start the application:

   ```bash
   ./vendor/bin/sail up -d
   ```

5. Apply database migrations:

   ```bash
   sail artisan migrate
   ```

6. Compile assets and run the Vue frontend:

   ```bash
   npm run dev
   ```

## Usage

### Build Your Profile

Create a comprehensive profile by adding your personal information, work experience, education history, and notable projects. This profile forms the foundation for our AI assistant, enabling it to provide tailored support throughout your job application process, from resume optimization to interview preparation.

### Resumes

Easily upload your resume to the platform for centralized access, or leverage our AI assistant to enhance your resume specifically for the job you’re targeting. The assistant can offer personalized suggestions to improve your resume, ensuring it stands out to potential employers. 

### Cover Letters

Generate compelling cover letters with ease. Like with resumes, our AI assistant is equipped to help you craft customized cover letters tailored to each job application. Whether you’re starting from scratch or refining an existing template, the assistant provides actionable advice and creates tailored cover letter drafts that reflect your unique qualifications and experiences.

### Applications

Effortlessly manage all your job applications in one centralized location. Track the status of each application, receive timely reminders for upcoming interviews and tasks, and stay informed about your progress throughout the job search. Applicy simplifies the organization of your job search efforts, helping you stay on top of every application.

You can also harness the power of our AI assistant to generate tailored cover letters from your templates or optimize your resume for specific job applications. The assistant provides personalized recommendations to enhance your application materials, ensuring they are perfectly aligned with the job you’re pursuing.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE.txt) file for more details.

