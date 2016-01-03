---
layout: post
title:  "第一个storm程序--maven"
date:   2016-01-03 18:00:01 +0800
categories: setup env 
---
0. 源代码地址
https://github.com/keything/big-data.git
1. 创建一个Maven项目

mvn archetype:generate -DarchetypeArtifactId=maven-archetype-quickstart -DgroupId=com.microsoft.example -DartifactId=WordCount -DinteractiveMode=false

2. 创建pom.xml
    git地址中的word_count/pom.xml
3. 写源代码
    git 地址中的word_count/src/main/java/com/microsoft/example/
4. 本地测试拓扑结构

    mvn compile exec:java -Dstorm.topology=com.microsoft.example.WordCountTopology

    拓扑输出信息
    15398 [Thread-16-split] INFO  backtype.storm.daemon.executor - Processing received message source: spout:10, stream: default, id: {}, [an apple a day keeps thedoctor away]]
    15398 [Thread-16-split] INFO  backtype.storm.daemon.task - Emitting: split default [an]
    15399 [Thread-10-count] INFO  backtype.storm.daemon.executor - Processing received message source: split:6, stream: default, id: {}, [an]
    15399 [Thread-16-split] INFO  backtype.storm.daemon.task - Emitting: split default [apple]
    15400 [Thread-8-count] INFO  backtype.storm.daemon.executor - Processing received message source: split:6, stream: default, id: {}, [apple]
    15400 [Thread-16-split] INFO  backtype.storm.daemon.task - Emitting: split default [a]
    15399 [Thread-10-count] INFO  backtype.storm.daemon.task - Emitting: count default [an, 53]
    15400 [Thread-12-count] INFO  backtype.storm.daemon.executor - Processing received message source: split:6, stream: default, id: {}, [a]
    15400 [Thread-16-split] INFO  backtype.storm.daemon.task - Emitting: split default [day]
    15400 [Thread-8-count] INFO  backtype.storm.daemon.task - Emitting: count default [apple, 53]
    15401 [Thread-10-count] INFO  backtype.storm.daemon.executor - Processing received message source: split:6, stream: default, id: {}, [day]
    15401 [Thread-16-split] INFO  backtype.storm.daemon.task - Emitting: split default [keeps]
    15401 [Thread-12-count] INFO  backtype.storm.daemon.task - Emitting: count default [a, 53]
    As you can see from this output, the following occurred:

    Spout emits "an apple a day keeps the doctor away."

    Split bolt begins emitting individual words from the sentence.

    Count bolt begins emitting each word and how many times it has been emitted.


        
5. 参考文章
https://azure.microsoft.com/en-us/documentation/articles/hdinsight-storm-develop-java-topology/
