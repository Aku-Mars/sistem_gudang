# Mindcraft - Cloud Computing

## Base URL

Mindcraft API Documentation (Bangkit Product Based Capstone Project - C242-PS406)

```sh
https://petot-mindcraft.cloud/docs
```

## Cloud Technology

_The cloud technology used in Mindcraft_

**Powered by:**

<p style="text-align: center; background-color: #eee; display: inline-block; padding: 14px 20px; border-radius: 15px;">
<img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Google_Cloud_logo.svg" width="250"/>
</p>

Google Cloud Platform (GCP) is a Google-provided set of cloud computing services. It is a platform that offers computing infrastructure and services for running applications, storing and managing data, and developing software solutions.


The cloud technology used in this project:

-   **Google Cloud Platform**: Suite of cloud computing services provided by Google.  
-   **Cloud SQL**: For the application database.  
-   **Cloud Storage**: For storing the assets.  
-   **Cloud Run**: For deploying machine learning model.  
-   **Memorystore Redis**: For caching and managing session data.  
-   **Load Balancer**: For distributing traffic across multiple backend services to ensure high availability and reliability.  
-   **Pub/Sub**: For asynchronous messaging and event-driven communication between services.  

## Technology Used

There are four applications of Google Cloud technologies in the **Mindcraft** application: Cloud SQL, Cloud Storage, Cloud Run and Memorystore Redis. On the cloud side, these three services are utilized to handle all requests and provide data services.

### Cloud SQL

<img src="https://k21academy.com/wp-content/uploads/2021/03/cloud-SQL.png" width="120" height="100"/>

This firestore service **`has been deployed`** on development environment.

Service details:

```YAML
Database Type   : PostgreSQL
Location        : asia-southeast2
Storage         : 10 GB
```

Docs: [firestore-docs](https://cloud.google.com/firestore/docs)

### Cloud Storage

<img src="https://symbols.getvecta.com/stencil_4/47_google-cloud-storage.fee263d33a.svg" width="100" height="50"/>

This storage service **`has been deployed`**. on development environment.

```YAML
Location Type   : Region
Location        : asia-southeast2
Storage Class   : Standard
```

Docs: [cloud-storage-docs](https://cloud.google.com/storage/docs)

### Cloud Run

<img src="https://www.vectorlogo.zone/logos/google_cloud_run/google_cloud_run-ar21.svg" width="150" height="150"/>

This cloud run service **`has been deployed`**. on development environment.

```YAML
Location        : asia-southeast2
CPU             : 12
Memory          : 10

```

Docs: [cloud-run-docs](https://cloud.google.com/run/docs)


### Memorystore Redis

<img src="https://dt-cdn.net/hub/logos/google-cloud-memorystore-for-redis.png" width="150" height="150"/>

This Memorystore Redis **`has been provisioned`** on the development environment.

```YAML
Location        : asia-southeast2
Tier            : Standard
Memory          : 1GB
Redis Version   : 7.0
```

Docs: [memorystore-redis-docs](https://cloud.google.com/memorystore/docs/redis)

### Load Balancer

<img src="https://miro.medium.com/v2/resize:fit:614/1*u95QsM2JaE-wqYQkJ7Cs4w.png" width="150" height="150"/>

This Load Balancer **`has been configured`** on the development environment.

```YAML
Location          : asia-southeast2
Type              : HTTP(S)
Backend Services  : 5
Certificate       : Managed SSL
```

Docs: [load-balancer-docs](https://cloud.google.com/load-balancing/docs)

---

### Pub/Sub

<img src="https://cdnlogo.com/logos/g/76/google-cloud-pub-sub.svg" width="150" height="150"/>

This Pub/Sub service **`has been provisioned`** on the development environment.

```YAML
Location        : asia-southeast2
Topic Count     : 5
Subscription    : 10
Retention       : 7 days
```

Docs: [pub-sub-docs](https://cloud.google.com/pubsub/docs)
