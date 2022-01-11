# Robot Forward Kinematics -Tips for the D-H coordinate system establishment

The D-H parameters themselves are not complicated, but initially, I felt very confused when I applied them to the robot to establish the coordinate system. There are many reasons for the feeling of confusion, summarized as follows:

- [x] It is not easy to distinguish each linkage on the robot, and the numbering of the links can be easily confused.
- [x] It is a little hard to determine whether a distance is the link offset $ d $ or the length of the link $ a $.
- [x] It's difficult to determine the x-axis direction of the coordinate system.
- [x] After establishing the coordinate system, we found that we couldn't make each coordinate system overlap.

So are there any tips for establishing a DH coordinate system? Let's introduce how to quickly set the D-H coordinate system of a robot.

## 1. Figuring out joints and links

The first step is to figure out the locations of joint 1 , link 1 , the origin of the coordinate system 1 that is solidly connected to link 1, and so on. Again, I want to emphasize that the DH coordinate system is built on the link's drive axis away from the base. So for a tandem robot, the joints, links, and the coordinate system should be arranged in order of distance from the base: first is joint 1, followed by link 1 mounted on joint 1, followed by coordinate system 1 attached to link 1, followed by joint 2. Please note that the axis of the z-axis of the coordinate system of connecting link1 is the drive axis of link 2.

Let's take the WAM robot arm to establish the DH coordinate system as an example. To make it easy to see each link, I have painted each link with a different color, as shown in the figure below.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/11.7jhbxeyz650.webp)

Imagine whether you can see all the links at once without coloring them? Would you know where the coordinate system for link 1 should be established?

## 2. Plot z-axis

In the second step， we need to determine the z-axis of each link. This step is pretty easy because the z-axis should be in the same direction as the joint axes in a rule. So the only thing you need to figure out is which links these z-axes should be fixed. Since the DH parameters should be built on the drive link, those z-axes must be built on the side of the links away from the base.

We paint the coordinate system fixed to the link with the same color.