<h1>Nerdina Entertainment Monthly Report</h1>

<h2>Raw Data & Analysis Objective</h2>

<p>There is a company called Nerdina Entertainment (Nerdina for short). It's been decided to optimize the operation costs of 4 departments (see below). These have 4 types of specialists on staff. Each of the 4 types is characterized by three base properties: pay rate per month, gallons of coffee consumed per month and (just for the fun of it) the amount of code units (whatever this means) produced per month. Additionally, Nerdina employs a system of grades: each employee is assigned a grade that affects their monthly pay rate. The chief of a department is a special status that alters all of the base stats. The summary of the available data is in the next sections.</p>
  
<p>The preliminary goal is to produce a report like this:</p>

<table>
  <tr>
    <th>DEPARTMENT</th>
    <th>STAFF</th>
    <th>LABOR COST</th>
    <th>COFFEE DRUNK</th>
    <th>CODE UNITS</th>
    <th>COST PER UNIT</th>
  </tr>
  <tr>
    <td>Analytics</td>
    <td>17</td>
    <td>142,450</td>
    <td>102</td>
    <td>1,160</td>
    <td>122.8</td>
  </tr>
  <tr>
    <td>Training</td>
    <td>16</td>
    <td>129,050</td>
    <td>102</td>
    <td>1,265</td>
    <td>102.02</td>
  </tr>
  <tr>
    <td>Development</td>
    <td>36</td>
    <td>335,150</td>
    <td>240</td>
    <td>3,175</td>
    <td>105.56</td>
  </tr>
  <tr>
    <td>Sales</td>
    <td>28</td>
    <td>225,450</td>
    <td>131</td>
    <td>1,045</td>
    <td>215.74</td>
  </tr>
  <tr>
    <td>TOTAL</td>
    <td>97</td>
    <td>832,100</td>
    <td>575</td>
    <td>6,645</td>
    <td>546.12</td>
  </tr>
  <tr>
    <td>AVERAGE</td>
    <td>24.25</td>
    <td>208,025</td>
    <td>143.75</td>
    <td>1,661.25</td>
    <td>136.53</td>
  </tr>
</table>

<h2>Employee Types</h2>

<p>Base stats. The figures for pay rate, coffee consumption and code units produced is per month.</p>

<table>
  <tr>
    <th>TYPE</th>
    <th>PAYRATE</th>
    <th>COFFEE</th>
    <th>CODE UNITS</th>
  </tr>
  <tr>
    <td>Manager</td>
    <td>7,000</td>
    <td>5</td>
    <td>75</td>
  </tr>
  <tr>
    <td>Marketer</td>
    <td>6,600</td>
    <td>4</td>
    <td>5</td>
  </tr>
  <tr>
    <td>Engineer</td>
    <td>8,300</td>
    <td>8</td>
    <td>200</td>
  </tr>
  <tr>
    <td>Ananyst</td>
    <td>7,500</td>
    <td>12</td>
    <td>125</td>
  </tr>
</table>

NOTE: Chief earns and drinks two times the base figure and doesn't produce any code.

<h2>Grades</h2>

<table>
  <tr>
    <th>GRADE</th>
    <th>PAYRATE</th>
  </tr>
  <tr>
    <td>1</td>
    <td>base</td>
  </tr>
  <tr>
    <td>2</td>
    <td>base×1.25</td>
  </tr>
  <tr>
    <td>3</td>
    <td>base×1.5</td>
  </tr>
</table>

<h2>Staff</h2>

<p>E.g. 6×man3 translates to 6 Managers of Grade 3</p>

<table>
  <tr>
    <th>DEPARTMENT</th>
    <th>STAFF</th>
  </tr>
  <tr>
    <td>Analytics</td>
    <td>9×man1, 3×man2, 2×ana3, 2×mar1 + chief 1×man2</td>
  </tr>
  <tr>
    <td>Training</td>
    <td>8×man1, 3×mar1, 2×ana1, 2×eng2 + chief 1×man2</td>
  </tr>
  <tr>
    <td>Development</td>
    <td>12×man2, 10×mar1, 8×eng2, 5×ana3 + chief 1×eng3</td>
  </tr>
  <tr>
    <td>Sales</td>
    <td>13×man1, 11×mar2, 3×mar3 + chief 1×man1</td>
  </tr>
</table>

<h1>Three Plans to Optimize the Production Costs</h1>

<h2>Plan A</h2>

<p>Lay off 40% of engineers in each department. Those of lower grades are the first to go. If the head of a department is an engineer, they are to retain their position. So basically heads of the departments are to stay on staff.</p>

<h2>Plan B</h2>

<p>Increase the base pay rate of the analysts up to $7,600 as well as their base coffee consumption to 14 gallons. If a department isn't led by an analyst, demote them and promote an analyst of the highest grade within this department to this position.</p>

<h2>Plan C</h2>

<p>50% of the managers of Grade 1 and 2 within each department are to be promoted up one grade to broaden the scope of their duties.</p>
