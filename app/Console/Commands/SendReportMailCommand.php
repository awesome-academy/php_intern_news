<?php

namespace App\Console\Commands;

use App\Mail\WeeklyReportMail;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReportMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly-report:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reports weekly';

    protected $userRepository;
    protected $articleRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository, ArticleRepositoryInterface $articleRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = $this->userRepository->getAdminUsers();
        $articles = $this->articleRepository->getPendingArticles();

        foreach ($users as $user) {
            $mail = new WeeklyReportMail($user, $articles);
            Mail::to($user->email)->queue($mail);
        }
    }
}
