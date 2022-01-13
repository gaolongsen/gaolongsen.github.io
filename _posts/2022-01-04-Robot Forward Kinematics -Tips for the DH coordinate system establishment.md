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

<iframe src="https://giphy.com/embed/wanSKXy2Hvf44sLjIP" width="700" height="379" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>

Imagine whether you can see all the links at once without coloring them? Would you know where the coordinate system for link 1 should be established?

## 2. Plot z-axis

In the second step， we need to determine the z-axis of each link. This step is pretty easy because the z-axis should be in the same direction as the joint axes in a rule. So the only thing you need to figure out is which links these z-axes should be fixed. Since the DH parameters should be built on the drive link, those z-axes must be built on the side of the links away from the base.

We paint the coordinate system fixed to the link with the same color.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_z.6lvj1omtv040.webp)

## 3. Determine the x-axis

In the third step, we need to determine the x-axis as the most challenging part of the whole process. Here you need to determine two things. First, you need to select the direction of the x-axis, and second, you need to figure out where the origin of the coordinate system is. That is, you need to determine the starting point of the x-axis.

### 3.1 x-axis direction

Let's address the first point. The X-axis of the DH coordinate system is the common vertical line between the drive and transmission draft of the connecting rod. So the direction of the x-axis is relatively easy to obtain. We know that the cross product (outer product) of two non-parallel vectors is the common normal of the two vectors. So we define.

<img src="https://latex.codecogs.com/svg.image?x_i&space;=&space;z_{i&space;-&space;1}&space;\times&space;z_i" title="x_i = z_{i - 1} \times z_i" />

In this way, you can determine the x-axis of each link coordinate system. Eventually, you can make all x-axes point uniformly at their transmission axes. When the drive and transmission axes are parallel, you can draw a vector that is perpendicular to and intersects both axes and that points to the transmission axis.

### 3.2 The start point of the x-axis (origin of the coordinate system)

Next, we need to figure out the second issue. How do we determine the origin for the x-axis? In advance, this problem does not exist when the drive axis and transmission axis are non-coplanar
because there is only one common vertical line for the non-coplanar lines. The origin has been determined with the x-axis (the intersection of the x-axis and z-axis).

In addition to non-coplanar straight lines, there are two other relationships between the drive and transmission axis, one is parallel and the other is intersecting. There are countless common perpendiculars between the drive and transmission axes in these two relationships. How to determine the origin of the coordinate system at this time?

According to D-H's rules, the common perpendicular line between the two z-axes represents the abstract link length. The length of the common vertical line between the two x-axes represents the offset of the adjacent links. It would help if you considered the physical meaning of these parameters when determining the origin of the coordinate system. Now we know z-axes and the directions of x-axes, as results, the lengths of the link($ \alpha $ in the DH parameters) can also be determined. Then we must make sure the coordinate system of link $i-1$ rotates around the $z_{i-1}$ axis and translates along the  $z_{i-1}$ axis to make $x_{i-1}$ and  $x_i$ coincide before we choose the origin of the x-axis. When you find that $x_{i-1}$ and $x_i$ cannot coincide by such transformation, there is a problem with choosing the origin of the link i. 

The above elaboration is still too obscure, let's use the WAM robot arm as an example to illustrate the process of determining the origin of the coordinate system.

Before we do that, let's determine the base coordinate system and the link1 coordinate system, usually the x-axis of the base points directly in front of the robot. Therefore, we can quickly determine the base frame. The drive and transmission axes of link 1 are non-coplanar straight lines, so the x-axis of the link1 coordinate system can also be easily determined from the cross multiplication equation mentioned earlier. Thus base frame and link1 can be specified as shown in the figure below.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_z_zb_x0.5krgyf6w7q40.webp)

Next, we start to determine the x-axis of llink2. We find that z0 and z1 are also non-coplanar lines, so by making a common vertical line of these two axes in the direction directly in front of the robot arm, we can quickly determine x1 as shown below.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_x1.1hgea2v7usgw.webp)

Similarly, we can find the axis x2,x3, x4, x5 and x6 in the same way as shown below

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_x6.44ekon8pbh40.webp)

For link 6, we find countless common vertical lines of z6 and z7. How can we determine the x-axis for this link? It is straightforward because the coordinate system of link5 has been determined. We need to make a paneled line with axis z7 through the origin of the link5 coordinate system. Finally, we translate this axis to the origin of the coordinate system of link6 to get axis x7

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_x7.36pzni9cvdo0.webp)