pipeline {
    agent any

    environment {
        COMPOSE_CMD = 'docker-compose -f /var/jenkins_home/workspace/Learn-Laravel/docker-compose.yml'
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', credentialsId: 'github-ssh', url: 'git@github.com:khoirulmustofa/Learn-Laravel.git'
            }
        }

        stage('Build Docker Containers') {
            steps {
                sh '${COMPOSE_CMD} build'
            }
        }

        stage('Start Laravel in Docker') {
            steps {
                sh '${COMPOSE_CMD} up -d'
            }
        }

        stage('Run Migrations') {
            steps {
                sh 'docker exec -it laravel_app php artisan migrate --force'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'docker exec -it laravel_app php artisan test'
            }
        }

        stage('Clean Up Old Containers') {
            steps {
                sh '${COMPOSE_CMD} down'
            }
        }
    }
}
