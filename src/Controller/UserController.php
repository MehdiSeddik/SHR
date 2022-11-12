<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class UserController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
        $this->playerRegistry = $doctrine->getRepository(User::class);
    }

    #[Route('/users', name: 'user_index', methods: ['GET'])]
    /**
     * Undocumented function
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->json($userRepository->findAll(), 200, [], ['groups' => 'user:read']);
    }

    #[Route('/users/{id}', name: 'user_show', methods: ['GET'])]
    /**
     * json get user by id
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->json($user, 200, [], ['groups' => 'user:read']);
    }

    #[Route('/register', name: 'user_register', methods: ['POST'])]
    /**
     * json register new user
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $requestContent = json_decode($request->getContent(), true);

        // check if email and password are set
        if (!isset($requestContent['email']) || !isset($requestContent['password'])) {
            return $this->json(['message' => 'Email and password are required'], 400);
        }
        // check if email is already used
        if ($this->playerRegistry->findOneBy(['email' => $requestContent['email']])) {
            return $this->json(['message' => 'Email already used'], 400);
        }

        $user = new User();

        // set user mail from request
        $user->setEmail($requestContent['email']);

        // set user hash pwd 
        $user->setPassword(password_hash($requestContent['password'], PASSWORD_BCRYPT));

        // persist and flush
        $this->em->persist($user);
        $this->em->flush();

        // return successfull message
        return $this->json(['message' => 'User created'], 201);
    }

    /**
     * json get all users
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    #[Route('/all', name: 'user_all', methods: ['GET'])]
    public function all(UserRepository $userRepository): Response
    {
        return $this->json($userRepository->findAll(), 200, [], ['groups' => 'user:read']);
    }
}
