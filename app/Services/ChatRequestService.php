<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;

class ChatRequestService
{
    public function __construct(
        protected User $user,
        protected Application $application
    ) {
        //
    }

    public function buildChatRequestPayload(): array
    {
        $applicationChatMessage = $this->buildApplicationChatMessage();
        $resumeChatMessages = $this->buildResumeChatMessages();

        $messages = [
            [
                'role' => 'system',
                'content' => 'Hello! I will provide you with detailed information about a user on this platform, including their personal details, education, work experience, and portfolio projects. Additionally, I will include a brief description of a job they intend to apply for. Based on this information, please write a cover letter for the user. I only want you to output the contents of the cover letter, no intro text or anything about it. Just pure cover letter content. Thank you!',
            ],
            [
                'role' => 'user',
                'content' => $applicationChatMessage,
            ],
        ];

        foreach ($resumeChatMessages as $chatMessage) {
            $messages[] = [
                'role' => 'user',
                'content' => $chatMessage,
            ];
        }

        return [
            'messages' => $messages,
        ];
    }

    protected function buildApplicationChatMessage(): string
    {
        $output = $this->application->position.' - '.$this->application->company_name.'('.$this->application->location.').'.PHP_EOL;
        $output .= $this->application->description;

        return 'Job Posting - '.$output;
    }

    protected function buildResumeChatMessages(): array
    {
        return [
            $this->buildEducationExperienceOutput(),
            $this->buildWorkExperienceOutput(),
            $this->buildPortfolioProjectsOutput(),
        ];
    }

    protected function buildEducationExperienceOutput(): string
    {
        $educationExperiences = $this->user->educationExperiences;
        $educationOutput = '';
        foreach ($educationExperiences as $educationExperience) {
            $educationOutput .= $educationExperience->institution_name.', '.$educationExperience->degree.', '.$educationExperience->field_of_study.', '.$educationExperience->start_date.' - '.$educationExperience->end_date.PHP_EOL;
            $educationOutput .= $educationExperience->description.PHP_EOL;
            $educationOutput .= 'Skills: '.$educationExperience->skills.PHP_EOL;
        }

        return 'Education - '.$educationOutput;
    }

    protected function buildWorkExperienceOutput(): string
    {
        $workExperience = $this->user->workExperiences;
        $workOutput = '';
        foreach ($workExperience as $work) {
            $workOutput .= $work->company_name.', '.$work->position.', '.$work->start_date.' - '.$work->end_date.PHP_EOL;
            $workOutput .= $work->description.PHP_EOL;
            $workOutput .= 'Skills: '.$work->skills.PHP_EOL;
        }

        return 'Experience - '.$workOutput;
    }

    protected function buildPortfolioProjectsOutput(): string
    {
        $portfolioProjects = $this->user->portfolioProjects;
        $projectsOutput = '';
        foreach ($portfolioProjects as $portfolioProject) {
            $projectsOutput .= $portfolioProject->project_name.PHP_EOL;
            $projectsOutput .= $portfolioProject->description.PHP_EOL;
            $projectsOutput .= $portfolioProject->skils.PHP_EOL;
        }

        return 'Projects - '.$projectsOutput;
    }
}
