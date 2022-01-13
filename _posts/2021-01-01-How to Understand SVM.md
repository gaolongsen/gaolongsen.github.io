---
layout:     post
title:      How to Understand SVM?
subtitle:   
date:       2022-01-01
author:     Longsen Gao
header-img: img/background2.jpg
catalog: 	true
tags:
    - Machine Learning
    - SVM

---

# Preface

In this paper, we conclude related introductions of SVM from as many kinds of documents to help the beginner understand SVM quickly. We start from fundamental theories and derivation of the essential functions for SVM to related examples and code display, which can help the reader understand SVM clearly. Related code source can be found at my Github resource: <https://github.com/gaolongsen/Popular-Machine-Learning-Algorithom-Python->

# What's SVM?

SVM, the abbreviation of Support Vector Machines, as one of the algorithms in the Machine Learning field, has been used to classify the data in linear or nonlinear problems. As one of the most popular algorithms during these years, it has been employed in many fields such as finance, Astronomy, aerospace, robotics, autonomous driving, etc. Let's give the readers an example to explain the SVM directly.

A long time ago, a warrior's wife was captured by the devil, so the warrior trekked through the mountains to find the devil, to save his wife from the hands of the devil. When he saw the devil, the devil was ready to play a game with him.

The devil put two colors of balls on the table with seeming regularity but with random distribution and said, "Can you separate them with a stick? Requirement: Try to keep the position of your stick in such a way that you can still separate them after putting more balls."

![](https://cuijiahua.com/wp-content/uploads/2017/11/ml_8_1.png)

Then the warrior do such as that:

![](https://cuijiahua.com/wp-content/uploads/2017/11/ml_8_2.png)

Then the devil put more balls on the table, and it seemed that one was on the wrong side of the table. The warrior needed to make adjustments to the stick.

![](https://cuijiahua.com/wp-content/uploads/2017/11/ml_8_3.png)

Here, the SVM is how to use such a line to separate two clusters of the balls and make sure the there exit largest distance between the nearest ball in each group and the dividing line we set at the beginning. 

![](https://www.cuijiahua.com/wp-content/uploads/2017/11/ml_8_4.png)

Even though the Devils put more balls in play, the stick is still a good dividing line.

![](https://www.cuijiahua.com/wp-content/uploads/2017/11/ml_8_5.png)

The devil saw that the warrior had learned a trick, so the devil decided to give the warrior a new challenge.

![](https://www.cuijiahua.com/wp-content/uploads/2017/11/ml_8_6.png)

Now, the warrior doesn't have a stick that can help him separate the two kinds of balls, now what should he do? There is no doubt that in all martial arts movies, the warrior table a tap, all the balls flew into the air. Then, the warrior used his kungfu to grab a piece of paper and inserted it into the middle of the two kinds of balls.

![](https://www.cuijiahua.com/wp-content/uploads/2017/11/ml_8_7.png)

A curve separates two kinds of balls perfectly by looking at the balls from the devil's perspective in the air.

![](https://www.cuijiahua.com/wp-content/uploads/2017/11/ml_8_8.png)

After that, people call these balls data, the sticks are called a ***classifier***, the trick to find the maximum gap is called ***optimization***, the tap on the table is called ***kernelling***, and the piece of paper is called ***hyperplane***.

Here is the video we can understand the example directly. 

<iframe width="560" height="315" src="https://www.youtube.com/embed/3liCbRZPrZA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

**Conclusion:** For classification problems, when the data is linearly divisible as when a stick can be used to separate two balls, we need to place the stick in a position that maximizes the distance of the balls from the stick, and the process of finding this maximum interval is called ***optimization***. However, the reality is often harsh; the general data is linearly indistinguishable. That is, it's so hard for us to find a stick to classify two kinds of balls perfectly. For this situation, we need to imitate the warrior to slap the table with force to make all the balls bounced from the surface of the table, and use a piece of paper instead of a stick to sort the balls. To make the data "fly," we need a kernel function, and the piece of paper used to slice the balls is the ***hyperplane***.



# Linear SVM

## Mathematical modeling

### Hyperplane Function

### Classification Interval Function

### Constraints

### Basic Description of The Linear SVM Optimization Problem

### Preparation for Solution

### Lagrangian Function

#### KKT

#### Dual Problem Analysis

#### STEP  1

#### STEP 2

## SMO Algorithm 

###  Jophn Platt's SMO

### How to understand SMO Algorithm





![4444444](http://1.15.231.3/pdf/pic/)

是不是很好看

<iframe src="//player.bilibili.com/player.html?aid=380232886&bvid=BV16Z4y1D7Yk&cid=471713245&page=1" scrolling="no" border="0" height="500" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>

<iframe src="http://1.15.231.3/pdf/lib/test.pdf" style="width:800px;" frameborder="0"></iframe>

/sum

### End



