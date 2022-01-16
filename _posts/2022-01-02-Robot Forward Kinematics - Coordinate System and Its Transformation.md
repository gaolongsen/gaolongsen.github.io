# Robot Forward Kinematics - Coordinate System and Its Transformation

I think robot kinematics is the core of the whole robotics. Take the SCARA robot as an example. As shown in the figure below, suppose the Cartesian coordinate system {A} is a fixed coordinate system. The red point **P** represents the end-effector of the robot link.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/red_add_P.4r9xi0zulea0.webp)

Imagine how to determine the coordinates of the point P in the coordinate system {A} if we know the current rotation angle of each joint of the robot? Such a problem has bothered me for a long time.

The first problem we encountered in robot kinematics is the forward kinematics problem. That is, determine the position of the robot's end-effector after knowing the status of each of its joints.

## 1. Description of position and posture

The robot kinematics is based on the coordinate system and its transformations, and this part has many interesting problems. Therefore, we use the coordinate system and its transformations as a breakthrough point to the positive kinematics of robotics.

## 1.1 Description of the position translation

Starting from the simplest case, as shown in the figure below, the axes of two coordinate systems {A} and {B} are parallel and let coordinate system {A} be the base coordinate system, then how to express the relationship between coordinate system B and coordinate system A?

