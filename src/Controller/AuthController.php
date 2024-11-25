<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;



use Symfony\Component\String\ByteString;


use Symfony\Component\HttpClient\HttpClient;

use Microsoft\Graph\GraphServiceClient;
use Microsoft\Kiota\Authentication\Oauth\AuthorizationCodeContext;





class AuthController extends AbstractController
{

    private $clientId = '47f85c4e-60ff-41e6-a9a5-79b11b0dccb3';
    private $tenantId = '13a1d2ad-f9fe-4c4b-a5b0-426ec3ce9050';
    private $clientSecret = 'a22cf0c4-1840-49bb-a089-6997926b7242';
    private $redirectUri = 'http://localhost:8000/callback';

 
    #[Route('/login/microsoft', name: 'app_auth')]
    public function loginWithMicrosoft(): RedirectResponse
    {
        $token = ByteString::fromRandom(32)->toString();
        $params=[
            'State' => $token,
            'client_id' => $this->clientId,            
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'response_mode' => 'query',
            'scope' => 'https://graph.microsoft.com/User.Read'
        ];
        $url = sprintf(
            'https://login.microsoftonline.com/%s/oauth2/v2.0/authorize',
            $this->tenantId,
        );

        $url=$url.'?'.http_build_query($params);

        return new RedirectResponse($url);
    }

    #[Route('/callback', name: 'callback_microsoft')]
    public function callback(Request $request): Response
    {
        $code = $request->query->get('code');

        if (!$code) {
            return new Response('Erro: Código de autorização não encontrado.', Response::HTTP_BAD_REQUEST);
        }

        $tokenUrl = sprintf(
            'https://login.microsoftonline.com/%s/oauth2/v2.0/token',
            $this->tenantId
        );
        return new Response('token url: '.$tokenUrl);
   /*
        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->redirectUri,
        ];

        $client = HttpClient::create();
        $response = $client->request('POST', $tokenUrl, [
            'body' => $params,
        ]);   
        if ($response->getStatusCode() !== 200) {
            return new Response('Erro ao obter o token de acesso.', Response::HTTP_BAD_REQUEST);
        }
    
        $data = $response->toArray();
    
        // Salvar o token de acesso (somente para teste)
        $accessToken = $data['access_token'];
        $refreshToken = $data['refresh_token'] ?? null;
    
        return new Response('Token de acesso obtido com sucesso.'.$accessToken);
*/
      /*  $graph = new GraphServiceClient();
        $graph->setAccessToken($accessToken);
    
        // Buscar informações do perfil do usuário
        $user = $graph->createRequest("GET", "/me")
                      ->setReturnType(Model\User::class)
                      ->execute();
    
        // Exibir informações do usuário (somente para teste)
        return new Response(sprintf(
            'Bem-vindo, %s (%s)!',
            $user->getDisplayName(),
            $user->getMail() ?? $user->getUserPrincipalName()
        ));*/


    }
}
