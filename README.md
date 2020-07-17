# Javacodewars

  Java Codewars web application was developed to help as an exercise storage for professors in the Java Programming course and is a medium for students and professors to do exercises. Since the old exercises do not attract students to want to do the exercises. And for professors, they must save the propositions on their own devices.
  
  The developed Java Codewars web application can meet the professor needs for enabling professors to store homework and exercises, so it is easy to search and use as an exercise in the following courses. Create courses as a medium for disseminating exercises to students. Allowing the professors to know the difficulty of the exercises on the students from the following information: exercise-taking time, examination with Test JUnit and Copy-Paste during doing exercises. The last one is to attract students to be more interested in doing exercises and the results of the exercises will be shown immediately. Furthermore, it also provides many exercises in many difficulty levels to practice. 

# Prerequisites

1. For Windows Server
2. Install **[xampp](https://www.apachefriends.org/download.html)** for windows
3. Install **[JDK](https://www.oracle.com/java/technologies/javase-downloads.html)**
4. Install [Junit4](https://junit.org/junit4/) consists of **[junit.jar](https://search.maven.org/search?q=g:junit%20AND%20a:junit)** and **[hamcrest-core.jar](https://search.maven.org/artifact/org.hamcrest/hamcrest-core/1.3/jar)**

# Installation (Back-end : PHP)

1. Import flie **javacodewars.sql** in **phpMydamin** of xampp **database name is _javacodewars_**
2. Take folder **javacodewars** to **C:\xampp\htdocs**
3. set connect database in **connect.php**

- connect.php

```
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "javacodewars";                   // database name
```

4. set path **JDK** on my own device example **_C:\Program Files\Java\jdk-13.0.1\bin_**

- questionComplie.php

```
putenv("PATH=C:\Program Files\Java\jdk-13.0.1\bin");
```

- studentRun.php

```
putenv("PATH=C:\Program Files\Java\jdk-13.0.1\bin");
```

- studentSubmit.php

```
putenv("PATH=C:\Program Files\Java\jdk-13.0.1\bin");
```

5. **Create folder in _C:/_ folder name _Junit4_**
6. Take **junit.jar** and **hamcrest-core.jar** go in folder **Junit4** ( folder Junit4 created on step 5. )

7. set path **Junit** on my own device example **_C:\Junit4_**

- questionComplie.php

```
$path_junit = "C:/Junit4/";                 // path Junit
$path_ver = "junit-4.13.jar";               // version junit
```

- studentRun.php

```
$pathJunit = "C:/Junit4/";                  // path Junit
$junit = "junit-4.13.jar" ;                 // version junit
$hamcrestCore = "hamcrest-core-1.3.jar";    // version hamcrestCore
```

- studentSubmit.php

```
$pathJunit = "C:/Junit4/";                  // path Junit
$junit = "junit-4.13.jar" ;                 // version junit
$hamcrestCore = "hamcrest-core-1.3.jar";    // version hamcrestCore
```

# Installation (Front-end : Angular)

1. Open **command line** into the folder **CS402** example **_C:\Users\User\Desktop\CS402_**
2. Use command `npm install`
3. Use command `ng build` will get folder name **dist**
4. Take folder **dist** to **C:\xampp\htdocs**
5. The path to the webpage is **localhost/dist**
