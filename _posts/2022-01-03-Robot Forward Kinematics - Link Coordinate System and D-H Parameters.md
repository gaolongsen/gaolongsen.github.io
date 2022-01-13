

```
---
layout:     post
title:      Robot Forward Kinematics - Link Coordinate System and D-H Parameters
subtitle:   
date:       2022-01-03
author:     Longsen Gao
header-img: img/background.jpg
catalog: 	 true
tags:
    - Robot Forward Kinematics
    - DH Parameter
---
```

# Robot Forward Kinematics - Link Coordinate System and D-H Parameters

## 1. Link Coordinate System

From the series of articles we introduced before on coordinate systems, we learned that the homogenous transformation matrix could be used to calculate the coordinates of a spatial point in each coordinate system. At the beginning of the article "**Robot Forward Kinematics - Coordinate Systems and their Transformations**," we posed the problem of how to solve the coordinates of the endpoint P of a multilink robot in the world coordinate system. Here, we can try to solve this problem.

Since relative motion can occur between the various connecting rods of the robot, it is tough to see where the endpoints are in the world coordinate system. So what can we do? We can decompose the problem to make each subproblem less challenging to solve.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/SCARA.2jedyl29kke0.webp)

Suppose we create a coordinate system with the end link fixed. In that case, the coordinates of point P in this coordinate system are easy to give because it is only related to the mechanical structure of the end link, not to the robot's motion. We call this a link coordinate system. A link coordinate system is a whole system that is solidly connected to each robot link. Suppose we create a fixed coordinate system on each connecting rod of the robot, and we find a way to solve the transformation relationship between every two adjacent rods. In that case, it will be easy to map the P-point coordinates to the world coordinate system (the transformation relationship between two adjacent rods is relatively easy to find).

The more critical question is how to solve the transformation relationship between two adjacent coordinate systems. It is not good to establish a linkage system arbitrarily. On the one hand, it will lead to a complex and diverse relationship between the coordinate systems, which is difficult to unify. On the other hand, we may need to make a lot of unnecessary parameter measurements. Therefore, we need to establish guidelines for the link system. We need the guideline to describe each coordinate system with as few parameters as possible, and we also want this guideline to be universally applicable.

This problem was solved by Jacques Denavit and Richard Hartenberg in 1995 when they proposed the famous DH-parameter method for establishing the coordinate system of a connecting rod. Only four parameters are needed to determine its link coordinate system in this guideline.

## 2. DH Parameters

### 2.1 Introduction of DH Parameter

The DH parameter is a kind of method to describe the link coordinate system, as shown in the figure below. It can be thought of as two adjacent links $Link_{i-1}$ and $Link_{i}$ in the robot. Here I still want to explain the meaning of the symbols in the diagram first, especially the subscript meaning, which I often get confused about when I study.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/liangan.5dfzbsxc7ag0.webp)

First, let's define two concepts, drive joints and transmission joints, which are easy to understand. We all know that there are usually servo motors driving at each joint for electrically driven robots. In a tandem robot, the joint of the $Link_i$ near the base drives the motion of $Link_i$. We call this the drive joint of $Link_i$. The joint of $Link_i$ near the end-effector is used to drive the motion of $Link_{i+1}$, so we call this joint the transmission joint of $Link_i$. The coordinate system established by D-H parameters is called the transmission axis coordinate system. Here we need to emphasize that the coordinate system of connecting rod i is built at the drive joint, which is the joint near the end-effector side. In other words,  the coordinate system $O_{i-1}x_{i-1}y_{i-1}z_{i-1}$ (abbreviated as $\{O_{i-1}\}$) is solidly connected with $Link_{i-1}$. The coordinate system $\{O_{i-1}\}$ is connected with $Link_i$.

$Axis_{i-1}$ corresponds to the drive axis of $Link_{i-1}$; Axis_{i} corresponds to the transmission axis of $Link_{i-1}$ and the drive axis of $Link_{i}$; $Axis_{i+1}$ corresponds to the transmission axis of $Link_{i}$.

The two pairs of straight circles 1 and 2 marked with a right slash are parallel straight lines, respectively. The $\theta_{i}$ , $d_{i}$ , $\alpha_{i}$ , and $a_{i}$ in the figure are the DH parameters of $Link_{i}$ that we are going to introduce.

### 2.2 Definition of DH Parameters

